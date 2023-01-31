<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Story extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'active_start_date',
        'active_end_date',
        'status',
        'sort',
    ];

    protected $with = ['media'];

    protected $casts = [
        'active_start_date' => 'datetime',
        'active_end_date' => 'datetime',
        'status' => 'string',
        'sort' => 'int',
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('story_logo')
            ->singleFile();

        $this
            ->addMediaCollection('story_items')
            ->singleFile();
    }
}
