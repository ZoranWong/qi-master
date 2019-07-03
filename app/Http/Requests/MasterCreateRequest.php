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
            'name' => 'required',
            'id_card_no' => 'required',
            'mobile' => 'required|phone_number',
            'captcha' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'emergency_mobile' => 'required|phone_number',
            'province_code' => 'required',
            'city_code' => 'required',
            'area_code' => 'required',
            'address' => 'required',
            'services' => 'required|array',// 服务，包括多个服务类目和服务类型
            'key_areas' => 'required|array',
            'other_areas' => 'required|array',
        ];
    }
}
