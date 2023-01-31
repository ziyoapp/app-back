<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\User;

class UserService
{
    public function list(array $filters = [], int $perPage = 15, string $order = 'desc')
    {
        $users = User::query()->whereIn('role_id', [UserRole::USER, UserRole::MODERATOR]);

        foreach ($filters as $filterField => $filterVal) {
            $users->where($filterField, $filterVal);
        }

        $users->orderBy('id', $order);

        return $users->paginate($perPage);
    }

    public function getById(int $userId)
    {
        return User::query()->whereIn('role_id', [UserRole::USER, UserRole::MODERATOR])->findOrFail($userId);
    }
}
