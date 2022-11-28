<?php

namespace App\Services\Traits;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait UploadImage
{
    protected function uploadPicture(Model $model, UploadedFile $image)
    {
        $model->addMedia($image)->toMediaCollection($model->getTable());
    }
}
