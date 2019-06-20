<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
        $guard = config('auth.defaults.guard', 'users');
        return [
            'mobile' => "bail|required|phone_number|unique:{$guard},mobile",
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ];
    }
}
