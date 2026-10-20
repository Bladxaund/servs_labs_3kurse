<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

// CRUD для статей
Route::resource('articles', ArticleController::class);

// Главная страница (теперь тоже через ArticleController)
Route::get('/', [ArticleController::class, 'index'])->name('home');

// Остальные маршруты (о нас, контакты, галерея, авторизация)
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contacts', function () {
    $contacts = [
        ['title' => 'Телефон',  'value' => '+7 (900) 123-45-67'],
        ['title' => 'Email',    'value' => 'info@example.com'],
        ['title' => 'Адрес',    'value' => 'г. Москва, ул. Пушкина, д. 10'],
        ['title' => 'Telegram', 'value' => '@my_site_support'],
    ];
    return view('contacts', ['contacts' => $contacts]);
})->name('contacts');
Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');

Route::get('/signin', [AuthController::class, 'create'])->name('signin');
Route::post('/signin', [AuthController::class, 'registration'])->name('registration.post');