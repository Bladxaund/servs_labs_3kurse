<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;

// --- 1. СТАТЬИ ---
Route::resource('articles', ArticleController::class)
    ->except(['index', 'show'])
    ->middleware('can:create,App\Models\Article');

Route::get('/', [ArticleController::class, 'index'])->name('home');

Route::get('/articles/{article}', [ArticleController::class, 'show'])
    ->name('articles.show')
    ->middleware('track.views');

// --- 2. АВТОРИЗАЦИЯ ---
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- 3. КОММЕНТАРИИ ---
Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::get('/moderate', [CommentController::class, 'moderate'])->name('comments.moderate')->middleware('auth');
Route::patch('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve')->middleware('auth');
Route::delete('/comments/{comment}/reject', [CommentController::class, 'reject'])->name('comments.reject')->middleware('auth');

// CRUD для комментариев (ДЗ 3)
Route::resource('comments', CommentController::class)->only(['edit', 'update', 'destroy'])->middleware('auth');

// --- 4. УВЕДОМЛЕНИЯ ---
Route::get('/notifications/{id}', [NotificationController::class, 'read'])->name('notifications.read')->middleware('auth');

// --- 5. ОСТАЛЬНЫЕ СТРАНИЦЫ ---
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