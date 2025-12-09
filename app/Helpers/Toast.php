<?php

namespace App\Helpers;

use Livewire\Component;

class Toast
{
    /**
     * Show success toast notification
     */
    public static function success(string $message): void
    {
        self::dispatch('success', $message);
    }

    /**
     * Show error toast notification
     */
    public static function error(string $message): void
    {
        self::dispatch('error', $message);
    }

    /**
     * Show warning toast notification
     */
    public static function warning(string $message): void
    {
        self::dispatch('warning', $message);
    }

    /**
     * Show info toast notification
     */
    public static function info(string $message): void
    {
        self::dispatch('info', $message);
    }

    /**
     * Dispatch Livewire toast event
     */
    protected static function dispatch(string $type, string $message): void
    {
        $component = self::getLivewireComponent();

        if ($component) {
            $component->dispatch('toast', [
                'type' => $type,
                'message' => $message,
            ]);
        }
    }

    /**
     * Get current Livewire component from backtrace
     */
    protected static function getLivewireComponent(): ?Component
    {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 15);

        foreach ($backtrace as $trace) {
            if (isset($trace['object']) && $trace['object'] instanceof Component) {
                return $trace['object'];
            }
        }

        return null;
    }
}
