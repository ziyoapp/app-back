<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class VerifyCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone', 'code_hash', 'type', 'attempt'
    ];

    protected $casts = [
        'code_hash' => 'integer',
        'attempt' => 'integer',
    ];

    public function checkCode(int $code): bool
    {
        return $code === $this->code_hash;
    }
}
