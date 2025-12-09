<?php

namespace App\Enums;

enum AlertType: string
{
    case ERROR = 'error';
    case WARNING = 'warning';
    case SUCCESS = 'success';
    case INFO = 'info';

    /**
     * Get SVG icon for alert type (Heroicons outline)
     */
    public function getIconSvg(): string
    {
        return match ($this) {
            self::ERROR   => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            self::WARNING => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>',
            self::SUCCESS => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
            self::INFO    => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        };
    }

    /**
     * Get icon background classes for toast style
     */
    public function getIconBgClasses(): string
    {
        return match ($this) {
            self::ERROR   => 'bg-red-900/30',
            self::WARNING => 'bg-amber-900/30',
            self::SUCCESS => 'bg-emerald-900/30',
            self::INFO    => 'bg-primary-900/30',
        };
    }

    /**
     * Get icon color classes
     */
    public function getIconColorClasses(): string
    {
        return match ($this) {
            self::ERROR   => 'text-red-400',
            self::WARNING => 'text-amber-400',
            self::SUCCESS => 'text-emerald-400',
            self::INFO    => 'text-primary-400',
        };
    }

    /**
     * Get alert banner classes (for full-width alerts)
     */
    public function getAlertClasses(): string
    {
        return match ($this) {
            self::ERROR   => 'bg-red-900/20 border-red-800/50 text-red-200',
            self::WARNING => 'bg-amber-900/20 border-amber-800/50 text-amber-200',
            self::SUCCESS => 'bg-emerald-900/20 border-emerald-800/50 text-emerald-200',
            self::INFO    => 'bg-primary-900/20 border-primary-800/50 text-primary-200',
        };
    }

    /**
     * Get all available session keys for auto-detection
     */
    public static function getSessionTypes(): array
    {
        return [
            self::ERROR->value,
            self::WARNING->value,
            self::SUCCESS->value,
            self::INFO->value,
        ];
    }

    /**
     * Localized label
     */
    public function getLabel(): string
    {
        return __('alerts.' . $this->value);
    }
}
