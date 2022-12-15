<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class News extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'locale',
        'title',
        'content',
        'description',
        'status',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    protected $hidden = [
        'locale'
    ];

    protected $with = ['media'];

    public function getPicture()
    {
//        $this->getMedia();
//
//        return [
//            'id' =>
//        ];
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection()
            ->singleFile();
    }
}
