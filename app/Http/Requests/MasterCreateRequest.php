<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterCreateRequest extends FormRequest
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
            'mobile' => 'required|phone_number',
            'captcha' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'emergency_mobile' => 'required|phone_number',
            'province_code' => 'required',
            'city_code' => 'required',
            'area_code' => 'required',
            'address' => 'required',
            'classification_id' => 'required',// 服务类目,
            'service_type_ids' => 'required|array',// 服务类型
            'key_areas' => 'required|array',
            'other_areas' => 'required|array',
        ];
    }
}
