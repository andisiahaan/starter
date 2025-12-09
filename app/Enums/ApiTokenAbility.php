<?php

namespace App\Enums;

enum ApiTokenAbility: string
{
    case CREATE = 'create';
    case READ = 'read';
    case UPDATE = 'update';
    case DELETE = 'delete';

    /**
     * Get human-readable label.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::CREATE => 'Create',
            self::READ => 'Read',
            self::UPDATE => 'Update',
            self::DELETE => 'Delete',
        };
    }

    /**
     * Get description for the ability.
     */
    public function getDescription(): string
    {
        return match ($this) {
            self::CREATE => 'Create new resources',
            self::READ => 'Read and view resources',
            self::UPDATE => 'Update existing resources',
            self::DELETE => 'Delete resources',
        };
    }

    /**
     * Get all abilities as array for forms/selects.
     */
    public static function toArray(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->getLabel(),
            'description' => $case->getDescription(),
        ], self::cases());
    }

    /**
     * Get all ability values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
