<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Exceptions\BadRequestException;
use App\Models\User;

class AuthService
{
    public function dashboardLogin(string $email, string $password)
    {
        $user = User::where('email', $email)->whereIn('role_id', [
            UserRole::ADMIN, UserRole::MODERATOR
        ])->first();

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
}
