<?php

namespace App\Http\Resources;

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
        $media = $this->getMedia('story_logo')->first();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'preview_img' => $this->when($media, [
                'id' => $media->id ?? 0,
                'src' => method_exists($media, 'getUrl') ? $media->getUrl() : ''
            ], []),
            'pictures' => $this->getMedia('story_items')->map(function ($media) {
                return [
                    'id' => $media->id,
                    'src' => $media->getUrl()
                ];
            }),
            'sort' => $this->sort,
            'status' => $this->status,
            #'active_start_date' => $this->active_start_date,
            #'active_end_date' => $this->active_end_date,
        ];
    }
}
