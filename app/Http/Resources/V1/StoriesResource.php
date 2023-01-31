<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class StoriesResource extends JsonResource
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
            'title' => $this->title,
            'preview_img_url' => $this->getFirstMediaUrl('story_logo') ?? '',
            'images' => $this->getMedia('story_items')->pluck('original_url'),
            #'active_start_date' => $this->active_start_date,
            #'active_end_date' => $this->active_end_date,
        ];
    }
}
