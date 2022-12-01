<?php

namespace App\Http\Requests;

use App\Enums\EntityStatus;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer'],
            'price_old' => ['nullable', 'integer'],
            'quantity' => ['required', 'integer'],
            'category_id' => ['required', 'exists:product_categories,id'],
            #'images' => ['array'],
            'images.*' => ['image', 'mimes:jpg,png,jpeg'],
            'status' => ['string', 'in:' . $statuses],
            'sort' => ['nullable','integer'],
        ];
    }
}
