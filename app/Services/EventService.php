<?php

namespace App\Services;

use App\Models\Event;
use App\Services\Traits\UploadImage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EventService
{
    use UploadImage;

    public function list(int $perPage = 15, string $order = 'desc')
    {
        $events = Event::query()->orderBy('published_at', $order);
        return $events->paginate($perPage);
    }

    public function create(array $data): Event
    {
        DB::beginTransaction();

        try {
            $event = Event::create(
                array_merge($data, [
                    'date_start_at' => Carbon::createFromFormat('Y-m-d H:i:s', $data['date_start']),
                    'date_end_at' => $data['date_end'] ? Carbon::createFromFormat('Y-m-d H:i:s', $data['date_end']) : null,
                    'published_at' => (!empty($data['published_date'])) ? $data['published_date'] : now()
                ])
            );

            if (!empty($data['image'])) {
                $this->uploadPicture($event, $data['image']);
                $event->load('media');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $event;
    }

    public function update(int $id, array $data): Event
    {
        $event = Event::findOrFail($id);

        DB::beginTransaction();

        try {
            $event->update(
                array_merge($data, [
                    'date_start_at' => Carbon::createFromFormat('Y-m-d H:i:s', $data['date_start']),
                    'date_end_at' => !empty($data['date_end']) ? Carbon::createFromFormat('Y-m-d H:i:s', $data['date_end']) : null,
                    'published_at' => Carbon::createFromFormat('Y-m-d H:i:s', $data['published_date'])
                ])
            );

            if (!empty($data['image'])) {
                $event->media()->first()->delete();
                $this->uploadPicture($event, $data['image']);
                $event->load('media');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $event;
    }
}
