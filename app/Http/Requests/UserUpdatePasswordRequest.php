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

        if ($uri === api_route('user.change.password')
            || $uri === api_route('user.change.wallet_password')
            || $uri === api_route('masters.change_password')
            || $uri === api_route('masters.change_wallet_password')
        ) {
            $rules['old_password'] = 'required|string|min:6';
            unset($rules['mobile']);
        } else if ($uri === api_route('user.set.wallet_password')
            || $uri === api_route('user.reset.wallet_password')
            || $uri === api_route('masters.set_wallet_password')
        ) {
            unset($rules['mobile']);
        }

        return $rules;
    }
}
