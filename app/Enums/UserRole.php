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
}
