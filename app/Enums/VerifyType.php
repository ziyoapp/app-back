<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class VerifyType extends Enum
{
    const REGISTER = 'register';
    const CHANGE_PASSWORD = 'change_password';
    const RESET_PASSWORD = 'reset_password';
}
