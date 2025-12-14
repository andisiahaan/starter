<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Alert;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PendingEmailChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Show the login view.
     */
    public function login()
    {
        if (! setting('auth.is_login_enabled', true)) {
            abort(403, 'Login is currently disabled.');
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function authenticate(Request $request)
    {
        if (! setting('auth.is_login_enabled', true)) {
            abort(403, 'Login is currently disabled.');
        }

        $maxAttempts = setting('auth.max_login_attempts', 5);
        $lockoutMinutes = setting('auth.lockout_duration_minutes', 1);
        
        // Check which login methods are enabled
        $isEmailEnabled = setting('auth.is_login_with_email_enabled', true);
        $isUsernameEnabled = setting('auth.is_login_with_username_enabled', false);
        
        // Determine the login field and throttle key
        $loginField = $request->input('login');
        $throttleKey = strtolower($loginField) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            Alert::error("Too many login attempts. Please try again in {$seconds} seconds.");
            return back()->withInput();
        }

        // Build validation rules with optional reCAPTCHA (for login)
        $recaptchaRule = (setting('captcha.provider', 'none') !== 'none' && setting('captcha.is_login_enabled', false))
            ? ['g-recaptcha-response' => ['required', new \App\Rules\Recaptcha]] 
            : [];

        // Validate based on what's enabled
        if ($isEmailEnabled && $isUsernameEnabled) {
            // Both enabled: accept email or username
            $request->validate(array_merge([
                'login' => ['required', 'string'],
                'password' => ['required'],
            ], $recaptchaRule));
        } elseif ($isUsernameEnabled) {
            // Only username
            $request->validate(array_merge([
                'login' => ['required', 'string'],
                'password' => ['required'],
            ], $recaptchaRule));
        } else {
            // Only email (default)
            $request->validate(array_merge([
                'login' => ['required', 'email'],
                'password' => ['required'],
            ], $recaptchaRule));
        }

        $remember = setting('auth.is_remember_me_enabled', true) && $request->boolean('remember');

        // Find user by email or username
        $user = null;
        if ($isEmailEnabled && filter_var($loginField, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $loginField)->first();
        } elseif ($isUsernameEnabled && !filter_var($loginField, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('username', $loginField)->first();
        }
        
        // If both enabled and not found by email, try username
        if (!$user && $isEmailEnabled && $isUsernameEnabled) {
            $user = User::where('email', $loginField)
                ->orWhere('username', $loginField)
                ->first();
        }

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            RateLimiter::hit($throttleKey, $lockoutMinutes * 60);
            Alert::error('The provided credentials do not match our records.');
            return back()->onlyInput('login');
        }

        // Check if user is banned
        if ($user->isBanned()) {
            Alert::error('Your account has been suspended. Reason: ' . ($user->ban_reason ?? 'No reason provided.'));
            return back()->onlyInput('email');
        }

        RateLimiter::clear($throttleKey);

        // Check if user has 2FA enabled
        if ($user->hasTwoFactorEnabled()) {
            // Store user ID in session for 2FA challenge
            session([
                'two_factor_user_id' => $user->id,
                'two_factor_remember' => $remember,
            ]);

            return redirect()->route('two-factor.challenge');
        }

        // No 2FA, proceed with normal login
        Auth::login($user, $remember);
        $request->session()->regenerate();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('Logged in');

        // Check if email verification is required and user hasn't verified
        $isEmailVerificationRequired = setting('auth.is_email_verification_required', false);
        if ($isEmailVerificationRequired && !$user->hasVerifiedEmail()) {
            Alert::info('Please verify your email address to continue.');
            return redirect()->route('verification.notice');
        }

        Alert::success('Welcome back!');
        return redirect()->intended('dashboard');
    }

    /**
     * Show the registration view.
     */
    public function register()
    {
        if (! setting('auth.is_registration_enabled', true)) {
            abort(403, 'Registration is currently disabled.');
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request)
    {
        if (! setting('auth.is_registration_enabled', true)) {
            abort(403, 'Registration is currently disabled.');
        }

        $minPasswordLength = setting('auth.min_password_length', 8);
        $isStrongPasswordRequired = setting('auth.is_strong_password_required', false);

        $passwordRule = ['required', 'confirmed', Rules\Password::min($minPasswordLength)];
        if ($isStrongPasswordRequired) {
            $passwordRule[] = Rules\Password::min($minPasswordLength)->mixedCase()->numbers()->symbols();
        }

        $validationRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $passwordRule,
            'phone' => setting('auth.is_phone_required', false) ? ['required', 'string', 'max:20'] : ['nullable', 'string', 'max:20'],
            'referral_code' => ['nullable', 'string', 'exists:users,referral_code'],
        ];

        // Add reCAPTCHA validation if enabled for registration
        if (setting('captcha.provider', 'none') !== 'none' && setting('captcha.is_registration_enabled', false)) {
            $validationRules['g-recaptcha-response'] = ['required', new \App\Rules\Recaptcha];
        }

        $validated = $request->validate($validationRules);

        // Phone handling if not in validated but model has it
        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ];

        if (isset($validated['phone'])) {
            $userData['phone'] = $validated['phone'];
        }

        // Handle referral code - from form, query, or cookie
        $referralCode = $validated['referral_code'] 
            ?? $request->query('referral_code') 
            ?? $request->cookie('referral_code');

        if ($referralCode && setting('referral.is_enabled', false)) {
            $referrer = User::where('referral_code', $referralCode)->first();
            if ($referrer) {
                $userData['referrer_id'] = $referrer->id;
            }
        }

        $user = User::create($userData);

        $defaultRole = setting('auth.default_role', 'user');
        if ($defaultRole) {
            $user->assignRole($defaultRole); // Requires Spatie Permissions
        }

        // Check if email verification is required
        $isEmailVerificationRequired = setting('auth.is_email_verification_required', false);
        
        if ($isEmailVerificationRequired) {
            // Send email verification notification
            $user->sendEmailVerificationNotification();
        }

        Auth::login($user);

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('Registered');

        // Redirect based on email verification requirement
        if ($isEmailVerificationRequired) {
            Alert::success('Account created successfully! Please check your email to verify your account.');
            return redirect()->route('verification.notice');
        }

        Alert::success('Account created successfully!');
        return redirect('dashboard');
    }

    /**
     * Redirect to Google.
     */
    public function redirectToGoogle()
    {
        if (! setting('auth.is_login_with_google_enabled', false)) {
            Alert::error('Google login is not enabled.');
            return back();
        }
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google Callback.
     */
    public function handleGoogleCallback()
    {
        if (! setting('auth.is_login_with_google_enabled', false)) {
            abort(403, 'Google login disabled.');
        }

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            Alert::error('Failed to login with Google.');
            return redirect('login');
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            if (! setting('auth.is_login_enabled', true)) {
                Alert::error('Login is disabled.');
                return redirect('login');
            }

            // Check if user is banned
            if ($user->isBanned()) {
                Alert::error('Your account has been suspended. Reason: ' . ($user->ban_reason ?? 'No reason provided.'));
                return redirect('login');
            }

            // Check if user has 2FA enabled
            if ($user->hasTwoFactorEnabled()) {
                session([
                    'two_factor_user_id' => $user->id,
                    'two_factor_remember' => true, // Auto remember for Google login
                ]);
                return redirect()->route('two-factor.challenge');
            }

            Auth::login($user, true); // Auto remember for Google login
            Alert::success('Logged in with Google!');
            return redirect('dashboard');
        } else {
            // Registration via Google
            if (! setting('auth.is_registration_with_google_enabled', true)) {
                Alert::error('Registration with Google is disabled.');
                return redirect('login');
            }

            // Check for referral code from cookie
            $userData = [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(str()->random(24)), // Random password
                'email_verified_at' => now(), // Auto-verify for Google (already set)
            ];

            // Handle referral code from cookie
            $referralCode = request()->cookie('referral_code');
            if ($referralCode && setting('referral.is_enabled', false)) {
                $referrer = User::where('referral_code', $referralCode)->first();
                if ($referrer) {
                    $userData['referrer_id'] = $referrer->id;
                }
            }

            $user = User::create($userData);

            $defaultRole = setting('auth.default_role', 'user');
            if ($defaultRole) {
                $user->assignRole($defaultRole);
            }

            Auth::login($user, true); // Auto remember for Google login
            Alert::success('Account created with Google!');
            return redirect('dashboard');
        }
    }

    /**
     * Verify email change token.
     */
    public function verifyEmailChange(Request $request, string $token)
    {
        $pendingChange = PendingEmailChange::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$pendingChange) {
            Alert::error('Invalid or expired email change link.');
            return redirect()->route('app.account');
        }

        $user = $pendingChange->user;
        $oldEmail = $user->email;
        $newEmail = $pendingChange->new_email;

        // Update email
        $user->email = $newEmail;
        $user->save();

        // Delete the pending change
        $pendingChange->delete();

        // Send notification to OLD email (security alert)
        \Illuminate\Support\Facades\Notification::route('mail', $oldEmail)
            ->notify(new \App\Notifications\Account\EmailChangedNotification($oldEmail, $newEmail, false));

        // Send notification to NEW email (welcome/confirmation)
        $user->notify(new \App\Notifications\Account\EmailChangedNotification($oldEmail, $newEmail, true));

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->withProperties([
                'old_email' => $oldEmail,
                'new_email' => $newEmail,
            ])
            ->log('Changed email address');

        Alert::success('Your email address has been updated to ' . $newEmail);
        return redirect()->route('app.account');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            activity()
                ->causedBy($user)
                ->performedOn($user)
                ->log('Logged out');
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::info('You have been logged out.');
        return redirect('/');
    }

    /**
     * Show the two-factor challenge view.
     */
    public function twoFactorChallenge()
    {
        if (!session('two_factor_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.two-factor-challenge');
    }

    /**
     * Handle the two-factor challenge verification.
     */
    public function verifyTwoFactor(Request $request)
    {
        $userId = session('two_factor_user_id');

        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);

        if (!$user) {
            session()->forget(['two_factor_user_id', 'two_factor_remember']);
            Alert::error('User not found.');
            return redirect()->route('login');
        }

        // Check if user is banned
        if ($user->isBanned()) {
            session()->forget(['two_factor_user_id', 'two_factor_remember']);
            Alert::error('Your account has been suspended. Reason: ' . ($user->ban_reason ?? 'No reason provided.'));
            return redirect()->route('login');
        }

        $useRecoveryCode = $request->boolean('use_recovery_code');
        $service = new \App\Services\TwoFactorService();

        if ($useRecoveryCode) {
            $request->validate([
                'code' => ['required', 'string'],
            ]);

            if (!$service->verifyRecoveryCode($user, $request->code)) {
                return back()->withErrors(['code' => __('auth.two_factor_challenge.error_recovery_invalid')]);
            }

            activity()
                ->causedBy($user)
                ->performedOn($user)
                ->log('Used recovery code for login');
        } else {
            $request->validate([
                'code' => ['required', 'string', 'size:6'],
            ]);

            if (!$service->verify($user->two_factor_secret, $request->code)) {
                return back()->withErrors(['code' => __('auth.two_factor_challenge.error_code_invalid')]);
            }
        }

        // Clear the pending 2FA session
        $remember = session('two_factor_remember', false);
        session()->forget(['two_factor_user_id', 'two_factor_remember']);

        // Log the user in
        Auth::login($user, $remember);
        $request->session()->regenerate();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('Logged in with two-factor authentication');

        Alert::success('Welcome back!');
        return redirect()->intended('dashboard');
    }

    /**
     * Show the email verification notice page.
     */
    public function verificationNotice(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended('dashboard')
            : view('auth.verify-email');
    }

    /**
     * Handle email verification.
     */
    public function verifyEmail(Request $request, int $id, string $hash)
    {
        $user = User::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }

        if ($user->hasVerifiedEmail()) {
            Alert::info('Your email is already verified.');
            return redirect()->intended('dashboard');
        }

        $user->markEmailAsVerified();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('Verified email address');

        Alert::success('Your email address has been verified!');
        return redirect()->intended('dashboard');
    }

    /**
     * Resend the email verification notification.
     */
    public function resendVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            Alert::info('Your email is already verified.');
            return redirect()->intended('dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        Alert::success('A new verification link has been sent to your email address.');
        return back();
    }

    /**
     * Show the forgot password form.
     */
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send a password reset link to the user.
     */
    public function sendResetLink(Request $request)
    {
        $validationRules = [
            'email' => ['required', 'email'],
        ];

        // Add reCAPTCHA validation if enabled for forgot password
        if (setting('captcha.provider', 'none') !== 'none' && setting('captcha.is_forgot_password_enabled', false)) {
            $validationRules['g-recaptcha-response'] = ['required', new \App\Rules\Recaptcha];
        }

        $request->validate($validationRules);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Don't reveal if email exists for security
            Alert::success('If an account exists with that email, you will receive a password reset link.');
            return back();
        }

        // Generate token
        $token = \Illuminate\Support\Str::random(64);
        
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        // Send email
        $user->notify(new \App\Notifications\Auth\ResetPasswordNotification($token));

        Alert::success('If an account exists with that email, you will receive a password reset link.');
        return back();
    }

    /**
     * Show the password reset form.
     */
    public function resetPassword(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $minPasswordLength = setting('auth.min_password_length', 8);
        $isStrongPasswordRequired = setting('auth.is_strong_password_required', false);

        $passwordRule = ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min($minPasswordLength)];
        if ($isStrongPasswordRequired) {
            $passwordRule[] = \Illuminate\Validation\Rules\Password::min($minPasswordLength)->mixedCase()->numbers()->symbols();
        }

        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => $passwordRule,
        ]);

        $passwordReset = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            Alert::error('Invalid or expired password reset token.');
            return back();
        }

        // Check if token is expired (60 minutes)
        if (now()->diffInMinutes($passwordReset->created_at) > 60) {
            Alert::error('Password reset token has expired.');
            return redirect()->route('password.request');
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            Alert::error('User not found.');
            return back();
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Delete the token
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('Password reset via forgot password');

        Alert::success('Your password has been reset successfully. Please login with your new password.');
        return redirect()->route('login');
    }
}
