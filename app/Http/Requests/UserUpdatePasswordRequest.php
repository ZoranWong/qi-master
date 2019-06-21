<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdatePasswordRequest extends FormRequest
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
        $uri = request()->getUri();

        $prefix = '';

        $rules = [
            'mobile' => 'bail|required|phone_number',
            "{$prefix}password" => 'required|string|min:6|confirmed',
            "{$prefix}password_confirmation" => 'required'
        ];

        if ($uri === '/api/users/changePwd' || $uri === '/api/users/changeWalletPwd') {
            $rules['old_password'] = 'required|string|min:6';
            unset($rules['mobile']);
        }

        return $rules;
    }
}
