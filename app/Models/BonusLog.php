<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ball',
        'operation',
        'type',
        'status',
        'comment'
    ];

    protected $casts = [
        'ball' => 'float'
    ];

    protected $with = ['props'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function props()
    {
        return $this->hasMany(BonusLogProp::class, 'bonus_log_id');
    }
}
