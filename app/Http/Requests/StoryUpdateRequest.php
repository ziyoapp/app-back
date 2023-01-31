<?php

namespace App\Http\Requests;

use App\Enums\EntityStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoryUpdateRequest extends FormRequest
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
            'preview_image' => ['image', 'mimes:jpg,png,jpeg'],
            'images.*' => ['image', 'mimes:jpg,png,jpeg'],
            'status' => ['required', 'string', 'in:' . $statuses],
            'sort' => ['nullable','integer'],
        ];
    }
}
