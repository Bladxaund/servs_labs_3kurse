<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController; // <-- Добавлено для лабы 3
use App\Http\Controllers\ArticleController;
// ==========================================
// ЛАБОРАТОРНАЯ 2 (Главная, Галерея)
// ==========================================
Route::get('/', [ArticleController::class, 'index'])->name('home'); // <-- Вот он, пропавший маршрут!
Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');


// ==========================================
// СТАРЫЕ СТРАНИЦЫ (О нас, Контакты)
// ==========================================
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {
    $contacts = [
        ['title' => 'Телефон',  'value' => '+7 (900) 123-45-67'],
        ['title' => 'Email',    'value' => 'info@example.com'],
        ['title' => 'Адрес',    'value' => 'г. Москва, ул. Пушкина, д. 10'],
        ['title' => 'Telegram', 'value' => '@my_site_support'],
    ];
    return view('contacts', ['contacts' => $contacts]);
})->name('contacts');


// ==========================================
// ЛАБОРАТОРНАЯ 3 (Регистрация)
// ==========================================
Route::get('/signin', [AuthController::class, 'create'])->name('signin');
Route::post('/signin', [AuthController::class, 'registration'])->name('registration.post');