<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // <-- Добавили импорт модели ролей
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Показ формы регистрации
    public function showRegister()
    {
        return view('auth.register');
    }

    // Сохранение нового пользователя с валидацией
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Ищем роль "Читатель" в базе данных, чтобы присвоить её новому пользователю
        $readerRole = Role::where('name', 'reader')->first();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $readerRole ? $readerRole->id : null, // <-- Присваиваем роль
        ]);

        // По заданию 6-й лабы: redirect на форму авторизации
        return redirect()->route('login')->with('success', 'Регистрация успешна! Теперь войдите.');
    }

    // Показ формы входа
    public function showLogin()
    {
        return view('auth.login');
    }

    // Аутентификация с присвоением токена сессии
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

    // Выход с удалением токена, сессии и обновлением CSRF
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Вы вышли из системы.');
    }
}