<?php

namespace App\Services\V1;

use App\Enums\UserRole;
use App\Enums\VerifyType;
use App\Exceptions\BadRequestException;
use App\Models\User;
use App\Models\VerifyCode;
use App\Notifications\OperSms\VerifyCodeSms;
use App\Services\Remote\SmsService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;

class AuthService
{
    protected $smsService;

    public function __construct()
    {
        $this->smsService = new SmsService();
    }

    public function sendVerifyCode(string $phone, string $verifyType): int
    {
        $isFakePhoneForTesting = !!(config('app.sms_test_phone') == $phone);

        if ($verifyType === VerifyType::REGISTER) {
            $user = User::where('phone', $phone)->first();

            if (!empty($user)) {
                throw new BadRequestException(__('bad_request.user_already_exists'));
            }
        }

        $verifyCode = VerifyCode::where('phone', $phone)->where('type', $verifyType)->first();

        if ($verifyCode) {
            if ($verifyCode->attempt >= config('app.auth_sms_send_limit')) {
                throw new BadRequestException(__('bad_request.sms_send_limit'));
            }

            $verifyCode->attempt++;
            $verifyCode->save();
        } else {
            $code = $isFakePhoneForTesting ? config('app.sms_test_code') : mt_rand(1000, 9999);

            $verifyCode = VerifyCode::create([
                'phone' => $phone,
                'code_hash' => $code,
                'type' => $verifyType,
                'attempt' => 1
            ]);
        }

        $this->smsService->send(
            new VerifyCodeSms($phone, $verifyCode->code_hash)
        );

        return $verifyCode->code_hash;
    }

    /**
     * @throws BadRequestException
     */
    public function auth(string $phone, string $password): string
    {
        $user = User::where('phone', $phone)->first();

        if (empty($user)) {
            throw new BadRequestException(__('bad_request.not_found_user'));
        }

        $credentials = [
            'phone' => $phone,
            'password' => $password
        ];

        if (!$token = auth()->attempt($credentials)) {
            throw new BadRequestException(__('bad_request.dont_correct_email'));
        }

        return $token;
    }

    public function register(array $registerData): User
    {
        $user = User::where('phone', $registerData['phone'])->first();

        if (!empty($user)) {
            throw new BadRequestException(__('bad_request.user_already_exists'));
        }

        $userData = [
            'first_name' => $registerData['first_name'] ?? null,
            'last_name' => $registerData['last_name'] ?? null,
            'birth_date' => !empty($registerData['birth_date']) ? Carbon::parse($registerData['birth_date'])->format('Y-m-d') : null,
            'email' => $registerData['email'] ?? null,
            'phone' => $registerData['phone'],
            'password' => bcrypt($registerData['password']),
            'role_id' => UserRole::USER,
            'gender' => $registerData['gender'] ?? null,
            'user_lang' => $registerData['user_lang'],
        ];

        return User::create($userData);
    }

    public function logout()
    {
        auth()->logout();
    }
}
