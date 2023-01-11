<?php

namespace App\Services\Remote;

use App\Interfaces\Sms\SmsInterface;
use App\Jobs\SendSmsJob;
use Illuminate\Support\Facades\App;

class SmsService
{
    public function send(SmsInterface $sms)
    {
        if (! App::isProduction()) {
            return;
        }

        if (config('SMS_SEND_FROM_QUEUE', false)) {
            SendSmsJob::dispatch($sms)->delay(1);
        } else {
            $sms->send();
        }
    }
}
