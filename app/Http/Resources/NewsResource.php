<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'status' => $this->status,
            'picture' => $this->when($media, [
                'id' => $media->id,
                'src' => $media->getUrl()
            ], []),
            'published_date' => $this->published_at->format('Y-m-d H:i:s')
        ];
    }
}
