<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Показ формы регистрации
    public function showRegister()
    {
        return view('auth.register');
    }

    // 1. Сохранение нового пользователя с валидацией
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // По заданию: redirect на форму авторизации
        return redirect()->route('login')->with('success', 'Регистрация успешна! Теперь войдите.');
    }

    // 2. Показ формы входа
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Аутентификация с присвоением токена сессии
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // Обновляем сессию (токен)
            return redirect()->intended(route('home'))->with('success', 'Вы вошли в систему!');
        }

        return back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ])->onlyInput('email');
    }

    // 3. Выход с удалением токена, сессии и обновлением CSRF
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Вы вышли из системы.');
    }
}