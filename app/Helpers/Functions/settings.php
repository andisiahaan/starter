<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    /**
     * Get a setting value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting(string $key, mixed $default = null): mixed
    {
        $parts = explode('.', $key);
        $section = array_shift($parts);
        $path = implode('.', $parts);

        // Cache Key: settings.{section}
        $cacheKey = "settings.{$section}";
        $ttl = config('cache.ttl', 3600);

        $config = Cache::remember($cacheKey, $ttl, function () use ($section) {
            $setting = Setting::where('section', $section)->first();
            return $setting ? $setting->config : null;
        });

        if (is_null($config)) {
            return $default;
        }

        if (empty($path)) {
            return $config;
        }

        return data_get($config, $path, $default);
    }
}
