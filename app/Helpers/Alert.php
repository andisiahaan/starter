<?php

namespace App\Helpers;

use App\Enums\AlertType;
use Illuminate\Support\Facades\Session;

class Alert
{
    /**
     * Flash a message using enum type
     */
    public static function message(AlertType $type, string $message): void
    {
        // Store message using the enum value as key
        Session::flash($type->value, $message);
    }

    /**
     * Shortcut for success
     */
    public static function success(string $message): void
    {
        self::message(AlertType::SUCCESS, $message);
    }

    /**
     * Shortcut for error
     */
    public static function error(string $message): void
    {
        self::message(AlertType::ERROR, $message);
    }

    /**
     * Shortcut for warning
     */
    public static function warning(string $message): void
    {
        self::message(AlertType::WARNING, $message);
    }

    /**
     * Shortcut for info
     */
    public static function info(string $message): void
    {
        self::message(AlertType::INFO, $message);
    }
}
