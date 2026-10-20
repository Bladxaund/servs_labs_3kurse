<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Метод для отображения страницы с формой (п. 8)
    public function create()
    {
        return view('auth.signin');
    }

    // Метод для обработки формы, валидации и вывода JSON (п. 6, 9)
    public function registration(Request $request)
    {
        // Валидация входящих данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ], [
            'name.required' => 'Поле Имя обязательно для заполнения.',
            'email.required' => 'Поле Email обязательно для заполнения.',
            'email.email' => 'Введите корректный Email.',
            'password.required' => 'Поле Пароль обязательно для заполнения.',
            'password.min' => 'Пароль должен содержать минимум 6 символов.',
        ]);

        // Возвращаем JSON-ответ с данными
        return response()->json([
            'status' => 'success',
            'message' => 'Данные успешно валидированы!',
            'data' => $validatedData
        ], 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}