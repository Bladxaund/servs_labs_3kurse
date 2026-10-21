<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

// --- ГЛАВНАЯ СТРАНИЦА ---
Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// --- СТАТЬИ (Только для модератора через Политику) ---
Route::resource('articles', ArticleController::class)
    ->except(['index', 'show'])
    ->middleware('can:create,App\Models\Article');

// --- АВТОРИЗАЦИЯ ---
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- ОСТАЛЬНЫЕ СТРАНИЦЫ ---
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