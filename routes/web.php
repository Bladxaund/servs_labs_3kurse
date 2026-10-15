<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

// Главная — вывод статей из JSON
Route::get('/', [MainController::class, 'index'])->name('home');

// Страница "О нас"
Route::get('/about', function () {
    return view('about');
})->name('about');

// Страница "Контакты"
Route::get('/contacts', function () {
    $contacts = [
        ['title' => 'Телефон',  'value' => '+7 (900) 123-45-67'],
        ['title' => 'Email',    'value' => 'info@example.com'],
        ['title' => 'Адрес',    'value' => 'г. Москва, ул. Пушкина, д. 10'],
        ['title' => 'Telegram', 'value' => '@my_site_support'],
    ];

    return view('contacts', ['contacts' => $contacts]);
})->name('contacts');

// Галерея — все полные изображения
Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');