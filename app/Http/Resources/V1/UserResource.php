<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name ?? 'User #' . $this->id,
            'last_name' => $this->last_name,
            'patronymic' => $this->patronymic,
            'phone' => $this->phone,
            'birth_date' => !empty($this->birth_date) ? $this->birth_date->format('d.m.Y') : null,
            'gender' => $this->gender,
            'nickname' => $this->nickname,
            'additional_info' => $this->additional_info,
            'email' => $this->email,
            'email_verified' => !empty($this->email_verified_at),
            'role' => [
                'role_id' => $this->role_id,
                'role_name' => 'user'
            ]
        ];
    }
}
