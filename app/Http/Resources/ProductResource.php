<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'price_old' => $this->price_old,
            'quantity' => $this->quantity,
            'category_id' => $this->categories->first()->id ?: null,
            'is_popular' => $this->is_popular,
            'pictures' => $this->media->map(function ($media) {
                return [
                    'id' => $media->id,
                    'src' => $media->getUrl()
                ];
            }),
            'status' => $this->status,
            'sort' => $this->sort,
        ];
    }
}
