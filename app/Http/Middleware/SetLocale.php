<?php

namespace App\Http\Middleware;

use App\Services\LanguageService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * Sets the application locale based on:
     * 1. Session (if user previously selected a language)
     * 2. Browser preference (Accept-Language header)
     * 3. Default app locale
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check session first (user's explicit choice)
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
            
            if (LanguageService::isAvailable($locale)) {
                app()->setLocale($locale);
                return $next($request);
            }
        }

        // 2. Check browser preference
        $browserLocale = $this->getBrowserLocale($request);
        if ($browserLocale && LanguageService::isAvailable($browserLocale)) {
            app()->setLocale($browserLocale);
            $request->session()->put('locale', $browserLocale);
            return $next($request);
        }

        // 3. Use default locale (already set in config/app.php)
        return $next($request);
    }

    /**
     * Get browser's preferred locale from Accept-Language header.
     */
    protected function getBrowserLocale(Request $request): ?string
    {
        $acceptLanguage = $request->header('Accept-Language');
        
        if (!$acceptLanguage) {
            return null;
        }

        // Parse Accept-Language header (e.g., "en-US,en;q=0.9,id;q=0.8")
        $languages = [];
        $parts = explode(',', $acceptLanguage);
        
        foreach ($parts as $part) {
            $part = trim($part);
            $segments = explode(';', $part);
            $locale = trim($segments[0]);
            $quality = 1.0;

            if (isset($segments[1])) {
                $qPart = trim($segments[1]);
                if (str_starts_with($qPart, 'q=')) {
                    $quality = (float) substr($qPart, 2);
                }
            }

            // Extract just the language code (e.g., "en-US" -> "en")
            $langCode = explode('-', $locale)[0];
            $languages[$langCode] = max($languages[$langCode] ?? 0, $quality);
        }

        // Sort by quality descending
        arsort($languages);

        // Return first available language
        foreach (array_keys($languages) as $lang) {
            if (LanguageService::isAvailable($lang)) {
                return $lang;
            }
        }

        return null;
    }
}
