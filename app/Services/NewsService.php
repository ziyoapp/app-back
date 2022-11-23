<?php

namespace App\Services;

use App\Models\News;
use App\Services\Traits\UploadImage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class NewsService
{
    use UploadImage;

    public function create(array $data): News
    {
        DB::beginTransaction();

        try {
            $news = News::create(
                array_merge($data, [
                    'locale' => 'ru',
                    'published_at' => (!empty($data['published_date'])) ? $data['published_date'] : now()
                ])
            );

            if (!empty($data['image'])) {
                $this->uploadPicture($news, $data['image']);
                $news->load('media');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $news;
    }

    public function update(int $id, array $data): News
    {
        $news = News::findOrFail($id);

        DB::beginTransaction();

        try {
            $news->update(
                array_merge($data, [
                    'published_at' => Carbon::createFromFormat('Y-m-d H:i:s', $data['published_date'])
                ])
            );

            if (!empty($data['image'])) {
                $imgMedia = $news->media()->first();

                if (!empty($imgMedia)) {
                    $imgMedia->delete();
                }

                $this->uploadPicture($news, $data['image']);
                $news->load('media');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $news;
    }

    public function list(int $perPage = 15, string $order = 'desc')
    {
        $news = News::query()->orderBy('published_at', $order);
        return $news->paginate($perPage);
    }
}
