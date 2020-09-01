<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return redirect()
            ->route('home')
            ->withErrors(['not_allowed' => 'You need to sign-in.']);
    }

    public function check()
    {
    $credentials = [
            'username' => request()->get('username'),
            'password' => request()->get('password'),
        ];

        $validator = \Illuminate\Support\Facades\Validator::make(
            request()->all(),
            [
                'username' => 'required|min:3|max:16',
                'password' => 'required|min:6|max:50',
            ]
        );

        if($validator->fails()){
            return redirect('/')
                ->withErrors($validator->errors());
        }

        $remember = request()->get('remember') === 'on';

        if(!Auth::attempt($credentials, $remember)){
            return back()
                ->withErrors(['username' => 'Username or password incorrect']);
        }

        return back();
    }

    public function logout()
    {
        Auth::logout();

        return back();
    }
}
