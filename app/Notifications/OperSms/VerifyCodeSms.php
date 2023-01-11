<?php

namespace App\Notifications\OperSms;

use App\Interfaces\Sms\SmsInterface;
use Illuminate\Support\Facades\Http;

class VerifyCodeSms implements SmsInterface
{
    protected $code;

    protected $phone;

    public function __construct(string $phone, int $code)
    {
        $this->code = $code;
        $this->phone = $phone;
    }

    public function getHost(): string
    {
        return config('services.oper_sms.host') . ':' . config('services.oper_sms.port');
    }

    public function getMessage(): string
    {
        return $this->code . " - Ваш код подтверждения";
    }

    public function send(): void
    {
        $data = [
            'login' => config('services.oper_sms.login'),
            'password' => config('services.oper_sms.password'),
            'data' => json_encode([
                [
                    'phone' => $this->phone,
                    'text' => $this->getMessage()
                ]
            ])
        ];

        Http::post($this->getHost(), $data);
    }
}
