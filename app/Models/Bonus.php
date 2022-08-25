<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'ball',
        'user_id'
    ];

    protected $casts = [
        'ball' => 'int'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
