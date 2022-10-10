<?php

namespace App\Http\Resources\V1;

use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'labels' => [
                $this->when($this->published_at > now()->subDays(3), [
                    'code' => 'new',
                    'name' => 'Новое'
                ])
            ],
            'type' => $this->eventType(),
            'subscribed' => $this->users()->where('user_id', auth()->id())->exists(),
            'title' => $this->trans('title'),
            'description' => $this->trans('description'),
            'content' => $this->trans('content'),
            'image_url' => $this->getFirstMediaUrl() ?? '',
            'address' => $this->trans('address'),
            'schedule_text' => $this->trans('schedule_text'),
            'date_start' => $this->date_start_at,
            'date_end' => $this->date_end_at,
            'ball' => $this->ball,
            'price_ball' => $this->price_ball,
            'register_count' => $this->register_count,
            'published_at' => $this->published_at
        ];
    }
}
