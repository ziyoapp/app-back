<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsListResource extends JsonResource
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
            'title' => $this->trans('title'),
            'description' => $this->trans('description'),
            'image_url' => $this->getFirstMediaUrl() ?? '',
            'date_start' => $this->date_start_at,
            'date_end' => $this->date_end_at,
            'published_at' => $this->published_at
        ];
    }
}
