<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class LanguageService
{
    /**
     * Cache key for available languages.
     */
    protected const CACHE_KEY = 'available_languages';

    /**
     * Get all available languages with metadata.
     *
     * Supports both JSON translation files and folder-based translations.
     */
    public static function getAvailableLanguages(): array
    {
        return Cache::remember(self::CACHE_KEY, now()->addDay(), function () {
            $languages = [];
            $langPath = base_path('lang');

            // Check JSON files first (e.g., en.json, id.json)
            $jsonFiles = glob($langPath . '/*.json');
            foreach ($jsonFiles as $file) {
                $locale = pathinfo($file, PATHINFO_FILENAME);
                $content = json_decode(file_get_contents($file), true);

                if (isset($content['_metadata'])) {
                    $metadata = $content['_metadata'];
                    $languages[$locale] = [
                        'name' => $metadata['name'] ?? ucfirst($locale),
                        'native_name' => $metadata['native_name'] ?? $metadata['name'] ?? ucfirst($locale),
                        'flag' => $metadata['flag'] ?? self::getDefaultFlag($locale),
                        'locale' => $metadata['locale'] ?? $locale,
                        'direction' => $metadata['direction'] ?? 'ltr',
                    ];
                } else {
                    $languages[$locale] = self::buildDefaultLanguage($locale);
                }
            }

            // Check subdirectories (e.g., lang/en/, lang/id/)
            $directories = File::directories($langPath);
            foreach ($directories as $dir) {
                $locale = basename($dir);
                
                // Skip if already added from JSON
                if (isset($languages[$locale])) {
                    continue;
                }

                // Check for metadata.php or metadata.json in the folder
                $metadataFile = $dir . '/metadata.json';
                if (file_exists($metadataFile)) {
                    $metadata = json_decode(file_get_contents($metadataFile), true);
                    $languages[$locale] = [
                        'name' => $metadata['name'] ?? ucfirst($locale),
                        'native_name' => $metadata['native_name'] ?? $metadata['name'] ?? ucfirst($locale),
                        'flag' => $metadata['flag'] ?? self::getDefaultFlag($locale),
                        'locale' => $metadata['locale'] ?? $locale,
                        'direction' => $metadata['direction'] ?? 'ltr',
                    ];
                } else {
                    $languages[$locale] = self::buildDefaultLanguage($locale);
                }
            }

            return $languages;
        });
    }

    /**
     * Build default language metadata based on locale code.
     */
    protected static function buildDefaultLanguage(string $locale): array
    {
        $defaults = [
            'en' => ['name' => 'English', 'native_name' => 'English', 'flag' => '🇺🇸'],
            'id' => ['name' => 'Indonesian', 'native_name' => 'Bahasa Indonesia', 'flag' => '🇮🇩'],
            'es' => ['name' => 'Spanish', 'native_name' => 'Español', 'flag' => '🇪🇸'],
            'fr' => ['name' => 'French', 'native_name' => 'Français', 'flag' => '🇫🇷'],
            'de' => ['name' => 'German', 'native_name' => 'Deutsch', 'flag' => '🇩🇪'],
            'ja' => ['name' => 'Japanese', 'native_name' => '日本語', 'flag' => '🇯🇵'],
            'ko' => ['name' => 'Korean', 'native_name' => '한국어', 'flag' => '🇰🇷'],
            'zh' => ['name' => 'Chinese', 'native_name' => '中文', 'flag' => '🇨🇳'],
            'ar' => ['name' => 'Arabic', 'native_name' => 'العربية', 'flag' => '🇸🇦', 'direction' => 'rtl'],
            'pt' => ['name' => 'Portuguese', 'native_name' => 'Português', 'flag' => '🇧🇷'],
            'ru' => ['name' => 'Russian', 'native_name' => 'Русский', 'flag' => '🇷🇺'],
            'hi' => ['name' => 'Hindi', 'native_name' => 'हिन्दी', 'flag' => '🇮🇳'],
            'th' => ['name' => 'Thai', 'native_name' => 'ไทย', 'flag' => '🇹🇭'],
            'vi' => ['name' => 'Vietnamese', 'native_name' => 'Tiếng Việt', 'flag' => '🇻🇳'],
            'ms' => ['name' => 'Malay', 'native_name' => 'Bahasa Melayu', 'flag' => '🇲🇾'],
        ];

        $default = $defaults[$locale] ?? [
            'name' => ucfirst($locale),
            'native_name' => ucfirst($locale),
            'flag' => '🌐',
        ];

        return [
            'name' => $default['name'],
            'native_name' => $default['native_name'],
            'flag' => $default['flag'],
            'locale' => $locale,
            'direction' => $default['direction'] ?? 'ltr',
        ];
    }

    /**
     * Get default flag for common locales.
     */
    protected static function getDefaultFlag(string $locale): string
    {
        $flags = [
            'en' => '🇺🇸', 'id' => '🇮🇩', 'es' => '🇪🇸', 'fr' => '🇫🇷',
            'de' => '🇩🇪', 'ja' => '🇯🇵', 'ko' => '🇰🇷', 'zh' => '🇨🇳',
            'ar' => '🇸🇦', 'pt' => '🇧🇷', 'ru' => '🇷🇺', 'hi' => '🇮🇳',
            'th' => '🇹🇭', 'vi' => '🇻🇳', 'ms' => '🇲🇾',
        ];

        return $flags[$locale] ?? '🌐';
    }

    /**
     * Get metadata for a specific language.
     */
    public static function getLanguageMetadata(string $locale): ?array
    {
        $languages = self::getAvailableLanguages();
        return $languages[$locale] ?? null;
    }

    /**
     * Get available locale codes only.
     */
    public static function getAvailableLocales(): array
    {
        return array_keys(self::getAvailableLanguages());
    }

    /**
     * Check if a locale is available.
     */
    public static function isAvailable(string $locale): bool
    {
        return in_array($locale, self::getAvailableLocales());
    }

    /**
     * Get current language metadata.
     */
    public static function getCurrentLanguage(): ?array
    {
        return self::getLanguageMetadata(app()->getLocale());
    }

    /**
     * Set application locale.
     */
    public static function setLanguage(string $language): void
    {
        if (self::isAvailable($language)) {
            app()->setLocale($language);
            session()->put('locale', $language);
        }
    }

    /**
     * Clear language cache.
     */
    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
