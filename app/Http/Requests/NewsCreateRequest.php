<?php

namespace App\Http\Requests;

use App\Enums\EntityStatus;
use Illuminate\Foundation\Http\FormRequest;

class NewsCreateRequest extends FormRequest
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
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg'],
            'status' => ['string', 'in:' . $statuses],
            'published_date' => ['nullable', 'date_format:Y-m-d H:i:s']
        ];
    }
}
