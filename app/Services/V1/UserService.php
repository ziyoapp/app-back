<?php

namespace App\Services\V1;

use App\Enums\UserRole;
use App\Exceptions\BadRequestException;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

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
        $user->patronymic = $userData['patronymic'] ?? null;
        $user->birth_date = Carbon::parse($userData['birth_date'])->format('Y-m-d');
        $user->gender = $userData['gender'];
        $user->nickname = $userData['nickname'] ?? null;
        $user->email = $userData['email'] ?? null;
        $user->additional_info = $userData['additional_info'] ?? null;

        $user->save();

        return $user;
    }

    public function changePassword(int $userId, string $currentPassword, string $newPassword): User
    {
        /**
         * @var User $user
         */
        $user = User::findOrFail($userId);
        $isCorrectPassword = Hash::check($currentPassword, $user->password);
        $isAlreadyPassword = Hash::check($newPassword, $user->password);

        if (! $isCorrectPassword) {
            throw new BadRequestException(__('bad_request.dont_correct_current_pass'));
        }

        if ($isAlreadyPassword) {
            throw new BadRequestException(__('bad_request.new_pass_already'));
        }

        $user->password = bcrypt($newPassword);
        $user->save();

        return $user;
    }
}
