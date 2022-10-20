<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class EntityStatus extends Enum
{
    const PUBLISHED = 'publish';
    const DRAFT = 'draft';
}
