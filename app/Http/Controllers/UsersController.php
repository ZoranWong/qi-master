<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    //
    public function profile()
    {
        $view = null;
        $user = auth()->user();
        if(isMobile()){

        }else{
            $view = view('web.profile')->with([
                'selected' => 'profile',
                'currentMenu' => 'profile'
            ]);
        }
        return $view->with([
            'user' => $user
        ]);
    }

    public function security()
    {
        if(isMobile()){

        }else{
            return view('web.security')->with([
                'selected' => 'profile',
                'currentMenu' => 'security'
            ]);
        }
    }

    public function recharge()
    {
        $user = auth()->user();
        $token = JWTAuth::fromUser($user);
        if(isMobile()){

        }else{
            return view('web.recharge')->with([
                'selected' => 'wallet',
                'currentMenu' => 'recharge',
                //'token' => $token
            ]);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'phone_number', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function registerUser(Request $request)
    {
        $this->validator($request->toArray());
        $user = $this->create($request->toArray());
        if($user){
            auth()->login($user);
            return $this->registered($request, $user);
        }
        throw new HttpException('注册失败');
    }

    protected function registered(\Illuminate\Http\Request $request, $user)
    {
        return response(['redirect' => route('home')]);
    }
}
