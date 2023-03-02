<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class BonusLogStatus extends Enum
{
    const COMPLETED = 'completed';
    const CANCELED = 'canceled';
    const NEW = 'new';
}
