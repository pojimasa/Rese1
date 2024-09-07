<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
{
    try {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        event(new Registered($user));

        return redirect('thanks')->with('result', '会員登録が完了しました');
    } catch (\Throwable $th) {
        return redirect('register')->with('result', 'エラーが発生しました');
    }
}


    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect('/');
    } else {
        return redirect('login')
            ->withErrors(['email' => 'メールアドレスまたはパスワードが間違っております'])
            ->withInput();
    }
}

    public function getLogout()
    {
        Auth::logout();
        return redirect("login");
    }
}