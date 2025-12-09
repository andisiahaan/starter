<?php

namespace App\Http\Controllers;

use App\Services\ReferralService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ReferralController extends Controller
{
    public function __construct(
        protected ReferralService $referralService
    ) {}

    /**
     * Handle referral link redirect.
     * Sets referral cookie and redirects to register page.
     */
    public function redirect(Request $request, string $code)
    {
        // Check if referral system is enabled
        if (!$this->referralService->isEnabled()) {
            return redirect()->route('register');
        }

        // Validate referral code exists
        $referrer = $this->referralService->getUserByReferralCode($code);
        if (!$referrer) {
            return redirect()->route('register');
        }

        // Get cookie duration from settings
        $settings = $this->referralService->getSettings();
        $cookieDays = $settings['referral_cookie_days'];

        // Set referral code cookie
        $cookie = Cookie::make(
            'referral_code',
            $code,
            $cookieDays * 24 * 60 // Convert days to minutes
        );

        // Redirect to register with referral_code query param
        return redirect()
            ->route('register', ['referral_code' => $code])
            ->withCookie($cookie);
    }
}
