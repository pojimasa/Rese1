<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;


class AdminAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,
        ]);

        return redirect()->route('admin.login')->with('success', '登録が完了しました。');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_admin) {
                return redirect()->route('manager.dashboard');
            } else {
                return redirect()->route('manager.shops');
            }
        }

        return back()->withErrors([
            'email' => 'ログイン情報が正しくありません。',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function createStoreRepresentative(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|min:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_store_representative' => true,
        ]);

        return redirect()->route('manager.dashboard')->with('success', '店舗代表者が作成されました。');
    }

}

