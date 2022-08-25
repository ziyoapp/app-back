<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ADMIN()
 * @method static static MODERATOR()
 * @method static static USER()
 */
final class UserRole extends Enum
{
    const ADMIN = 1;
    const MODERATOR = 2;
    const USER = 3;

    public static function adminRole(): string
    {
        return self::getMiddleware(self::ADMIN);
    }

    public static function moderatorRole(): string
    {
        return self::getMiddleware(self::MODERATOR);
    }

    public static function userRole(): string
    {
        return self::getMiddleware(self::USER);
    }

    public static function getMiddleware(string $role): string
    {
        return 'auth.role:' . $role;
    }

    public static function middleware($role): string
    {
        if (is_array($role)) {
            return 'auth.role:' . implode(',', $role);
        }

        return 'auth.role:' . $role;
    }
}
