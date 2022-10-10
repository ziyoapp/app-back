<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_lang',
        'first_name',
        'last_name',
        'patronymic',
        'phone',
        'birth_date',
        'gender',
        'password',
        'email',
        'role_id',
        'events_push_enabled',
        'news_push_enabled',
        'products_push_enabled',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'events_push_enabled' => 'boolean',
        'news_push_enabled' => 'boolean',
        'products_push_enabled' => 'boolean',
    ];

    public function bonus()
    {
        return $this->hasOne(Bonus::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function events()
    {
        return $this->belongsToMany(Event::class)
            ->withPivot('price_ball')
            ->withTimestamps();
    }
}
