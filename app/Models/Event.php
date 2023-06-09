<?php

namespace App\Models;

use App\Enums\EntityStatus;
use App\Translation\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, Translatable;

    protected $fillable = [
        'title',
        'description',
        'content',
        'address',
        'ball',
        'price_ball',
        'register_count',
        'date_start_at',
        'date_end_at',
        'schedule_text',
        'status',
        'published_at',
    ];

    protected $with = ['media'];

    protected $casts = [
        'date_start_at' => 'datetime',
        'date_end_at' => 'datetime',
        'published_at' => 'datetime',
        'register_count' => 'int',
        'ball' => 'float',
        'price_ball' => 'float',
    ];

    public function eventType(): string
    {
        if ($this->price_ball > 0) {
            return 'exclusive';
        }

        return 'simple';
    }

    public static function currentDayActiveEvents()
    {
        return Event::query()
            ->whereDate('date_start_at', '<=', now()->toDateString())
            ->where(function ($query) {
                $query->whereDate('date_end_at', '>', now()->toDateString())
                    ->orWhereDate('date_start_at', '=', now()->toDateString());
            })
            ->where('status', EntityStatus::PUBLISHED)
            ->orderBy('date_start_at')
            ->limit(500)
            ->get();
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')
            ->singleFile();
    }

    public function bonusLogProps()
    {
        return $this->morphOne(BonusLogProp::class, 'entity');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('price_ball')
            ->withTimestamps();
    }
}
