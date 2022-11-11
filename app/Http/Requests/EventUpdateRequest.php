<?php

namespace App\Http\Requests;

use App\Enums\EntityStatus;
use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $statuses = implode(',', [EntityStatus::DRAFT, EntityStatus::PUBLISHED]);

        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'content' => ['required', 'string'],
            'address' => ['required', 'string'],
            'ball' => ['required', 'integer', 'min:0'],
            'price_ball' => ['nullable', 'integer', 'min:0'],
            'register_count' => ['required', 'integer', 'min:1'],
            'date_start' => ['required', 'date_format:Y-m-d H:i:s'],
            'date_end' => ['nullable', 'date_format:Y-m-d H:i:s'],
            'schedule_text' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'status' => ['string', 'in:' . $statuses],
            'published_date' => ['required', 'date_format:Y-m-d H:i:s']
        ];
    }
}
