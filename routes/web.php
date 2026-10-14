<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contacts', function () {
    $contacts = [
        ['name' => 'Телефон', 'value' => '+7 (999) 123-45-67'],
        ['name' => 'Email',   'value' => 'info@example.com'],
        ['name' => 'Адрес',   'value' => 'г. Москва, ул. Примерная, д. 1'],
    ];

    return view('pages.contacts', ['contacts' => $contacts]);
})->name('contacts');
