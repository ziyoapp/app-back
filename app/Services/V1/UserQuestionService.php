<?php

namespace App\Services\V1;

use App\Models\UserQuestion;

class UserQuestionService
{
    public function store(array $questionData): UserQuestion
    {
        return UserQuestion::create([
            'user_id' => $questionData['user_id'] ?? null,
            'email' => $questionData['email'],
            'text' => $questionData['text'],
        ]);
    }
}
