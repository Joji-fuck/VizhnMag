<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\Admin;

class AuthController extends Controller
{
    public function loginIndex(): View{
        $title = "Вход";
        return view('cms.auth.login', compact('title'));
    }
    public function registerIndex(): View{
        $title = "Регистрация";
        return view('cms.auth.register', compact('title'));
    }
    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'login'    => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'login'    => $data['login'],
            'password' => $data['password']
        ])) {
            $request->session()->regenerate();
            return to_route('cms.index');
        }

        return redirect()->back()->withErrors([
            'error' => 'Неправильный логин или пароль'
        ])->onlyInput('login');
    }
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'surname' => 'required',
            'name' => 'required',
            'login' => 'required',
            'password' => 'required|confirmed|min:6',
            'role' => 'required'
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = Admin::create($data);

        Auth::login($user);

        return to_route('cms.index');
    }
    public function logout(): RedirectResponse {
        Auth::logout();
        return to_route('home');
    }
}
