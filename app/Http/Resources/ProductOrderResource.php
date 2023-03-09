<?php

namespace App\Http\Resources;

use App\Enums\BonusLogStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = $this->props->first()->entity;

        return [
            'id' => $this->id,
            'user' => [
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
                'patronymic' => $this->user->patronymic,
                'phone' => $this->user->phone
            ],
            'product' => !empty($product) ? [
                'id' => $product->id,
                'name' => $product->name,
            ] : [],
            'ewr' => '222',
            'total_score' => abs($this->ball),
            'order_status' => $this->status ?: BonusLogStatus::NEW
        ];
    }
}
