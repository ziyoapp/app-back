<?php

namespace App\Http\Requests;

use App\Enums\BonusLogStatus;
use App\Enums\EntityStatus;
use Illuminate\Foundation\Http\FormRequest;

class ProductOrderStatusRequest extends FormRequest
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
        $statuses = implode(',', [BonusLogStatus::COMPLETED, BonusLogStatus::CANCELED]);

        return [
            'order_id' => ['required', 'integer'],
            'status' => ['required', 'string', 'in:' . $statuses]
        ];
    }
}
