<?php

namespace App\Http\Resources\V1;

use App\Enums\BonusLogOperation;
use App\Enums\BonusLogType;
use Illuminate\Http\Resources\Json\JsonResource;

class BonusHistoryResource extends JsonResource
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
            'opration_type' => $this->operation,
            'name' => $this->when($this->type, function () {
                if ($this->type === BonusLogType::EVENT) {
                    $eventNames = $this->props->pluck('entity')->pluck('title')->implode(', ');

                    return __('bonus.bonus_event_type') . ': ' . $eventNames;
                } else if ($this->type === BonusLogType::PRODUCT) {
                    return __('bonus.bonus_product_type') . ': Тест продукт';
                }

                return $this->operation === BonusLogOperation::ADD ? __('bonus.balance_added') : __('bonus.balance_minus');
            }),
            'ball' => (string) ($this->ball < 0 ? $this->ball : '+' . $this->ball),
            'currency' => 'YC',
            'comment' => $this->comment ?? '',
            'date' => $this->created_at->format('d.m.Y H:i')
        ];
    }
}
