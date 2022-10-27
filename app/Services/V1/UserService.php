<?php

namespace App\Services\V1;

use App\Enums\UserRole;
use App\Exceptions\BadRequestException;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;

class UserService
{
    public function update(int $userId, array $userData): User
    {
        /**
         * @var User $user
         */
        $user = User::findOrFail($userId);

        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->birth_date = Carbon::parse($userData['birth_date'])->format('Y-m-d');
        $user->phone = $userData['phone'];
        $user->gender = $userData['gender'];

        $user->save();

        return $user;
    }
}
