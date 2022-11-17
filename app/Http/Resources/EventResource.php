<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $media = $this->media->first();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description ?? '',
            'content' => $this->content ?? '',
            'address' => $this->address ?? '',
            'ball' => $this->ball ?? 0,
            'price_ball' => $this->price_ball ?? 0,
            'register_count' => $this->register_count,
            'date_start' => $this->date_start_at->format('Y-m-d H:i:s'),
            'date_end' => $this->date_end_at ? $this->date_end_at->format('Y-m-d H:i:s') : '',
            'schedule_text' => $this->schedule_text ?? '',
            'status' => $this->status,
            'picture' => $this->when($media, [
                'id' => $media->id ?? 0,
                'src' => method_exists($media, 'getUrl') ? $media->getUrl() : ''
            ], []),
            'published_at' => $this->published_at->format('Y-m-d H:i:s')
        ];
    }
}
