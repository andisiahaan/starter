<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware to ensure email is verified when enabled in settings.
 * Respects the dynamic 'auth.is_email_verification_required' setting.
 */
class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if email verification is required in settings
        $isEmailVerificationRequired = setting('auth.is_email_verification_required', false);
        
        if (!$isEmailVerificationRequired) {
            return $next($request);
        }

        // Check if user is logged in and has verified email
        if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Your email address is not verified.'], 403);
            }

            return redirect()->route('verification.notice');
        }

        return $next($request);
    }
}
