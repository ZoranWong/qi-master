<?php

namespace App\Http\Requests;

use App\Models\RefundOrder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RefundOrderCreateRequest extends FormRequest
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
        return [
            'refund_mode' => [
                'required',
                Rule::in(array_keys(RefundOrder::REFUND_MODES))
            ],
            'refund_method' => [
                'required',
                Rule::in(array_keys(RefundOrder::REFUND_METHODS))
            ],
            'amount' => 'required|numeric',
            'remark' => 'required',
            'order_id' => 'required',
        ];
    }
}
