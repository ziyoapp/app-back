<?php

namespace App\Services\V1;

use App\Models\BonusLog;
use App\Models\BonusLogProp;

class BonusLogService
{
    protected $bonusLog;
    protected $bonusLogProp;

    public function __construct()
    {
        $this->bonusLog = BonusLog::query();
        $this->bonusLogProp = BonusLogProp::query();
    }

    
}
