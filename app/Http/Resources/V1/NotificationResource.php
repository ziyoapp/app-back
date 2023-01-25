<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $array = explode('\\', $this->type);

        return [
            'id' => $this->id,
            'type' => end($array),
            'data' => $this->data,
            'is_read' => !empty($this->read_at),
            'date' => $this->created_at->format('d.m.Y H:i')
        ];
    }
}
