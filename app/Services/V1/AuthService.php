<?php

namespace App\Services\V1;

use App\Enums\UserRole;
use App\Exceptions\BadRequestException;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;

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

    public function register(array $registerData): User
    {
        $userData = [
            'first_name' => $registerData['first_name'],
            'last_name' => $registerData['last_name'],
            'birth_date' => Carbon::parse($registerData['birth_date'])->format('Y-m-d'),
            'email' => $registerData['email'],
            'phone' => $registerData['phone'],
            'password' => bcrypt($registerData['password']),
            'role_id' => UserRole::USER,
            'gender' => $registerData['gender'],
            'user_lang' => $registerData['user_lang'],
        ];

        return User::create($userData);
    }

    public function logout()
    {
        auth()->logout();
    }
}
