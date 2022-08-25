<?php

namespace App\Services\V1;

use App\Exceptions\BadRequestException;
use App\Models\User;

class AuthService
{
    /**
     * @throws BadRequestException
     */
    public function auth(string $email, string $password): string
    {
        $user = User::where('email', $email)->first();

        if (empty($user)) {
            throw new BadRequestException(__('bad_request.not_found_user'));
        }

        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        if (!$token = auth()->attempt($credentials)) {
            throw new BadRequestException(__('bad_request.dont_correct_email'));
        }

        return $token;
    }

    public function logout()
    {
        auth()->logout();
    }
}
