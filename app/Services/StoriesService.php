<?php

namespace App\Services;

use App\Models\Story;
use App\Services\Traits\UploadImage;
use Illuminate\Support\Facades\DB;

class StoriesService
{
    use UploadImage;

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $story = Story::create([
                'title' => $data['title'],
                'status' => $data['status'],
                'sort' => $data['sort'],
            ]);

            if (!empty($data['preview_image'])) {
                $this->uploadPicture($story, $data['preview_image'], 'story_logo');
            }

            if (!empty($data['images'])) {
                foreach ($data['images'] as $img) {
                    $this->uploadPicture($story, $img, 'story_items');
                }
            }

            $story->load(['media']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $story;
    }

    public function update(int $storyId, array $data): Story
    {
        $story = Story::withoutGlobalScope('published')->findOrFail($storyId);

        DB::beginTransaction();

        try {
            $story->update([
                'title' => $data['title'],
                'status' => $data['status'],
                'sort' => $data['sort'],
            ]);

            if (!empty($data['preview_image'])) {
                $imgMedia = $story->media('story_logo')->first();

                if (!empty($imgMedia)) {
                    $imgMedia->delete();
                }

                $this->uploadPicture($story, $data['preview_image'], 'story_logo');
            }

            if (!empty($data['images'])) {
                foreach ($data['images'] as $img) {
                    $this->uploadPicture($story, $img, 'story_items');
                }
            }

            $story->load(['media']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $story;
    }

    public function list(int $perPage = 15, string $order = 'desc')
    {
        $stories = Story::query()->withoutGlobalScope('published')
            ->orderByDesc('id')
            ->orderBy('sort', $order);

        return $stories->paginate($perPage);
    }
}
