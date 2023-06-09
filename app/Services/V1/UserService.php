<?php

namespace App\Services\V1;

use App\Enums\UserRole;
use App\Exceptions\BadRequestException;
use App\Models\User;
use App\Services\Traits\UploadImage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use UploadImage;

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

        if (!empty($userData['avatar'])) {
            $imgMedia = $user->getMedia('avatar')->first();

            if (!empty($imgMedia)) {
                $imgMedia->delete();
            }

            $this->uploadPicture($user, $userData['avatar'], 'avatar');
            $user->load('media');
        }

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

    public function resetPassword(string $phone, string $newPassword): User
    {
        /**
         * @var User $user
         */
        $user = User::where('phone', $phone)->first();

        if (empty($user)) {
            throw new BadRequestException(__('bad_request.not_found_user'));
        }

        $user->password = bcrypt($newPassword);
        $user->save();

        return $user;
    }
}
