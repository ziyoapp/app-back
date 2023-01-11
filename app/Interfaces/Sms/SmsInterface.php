<?php

namespace App\Interfaces\Sms;

interface SmsInterface
{
    public function getHost(): string;

    public function getMessage(): string;

    public function send(): void;
}
