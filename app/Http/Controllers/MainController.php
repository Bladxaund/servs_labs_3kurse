<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    /**
     * Главная — вывод статей из JSON.
     */
    public function index()
    {
        $json = file_get_contents(public_path('articles.json'));
        $articles = json_decode($json, true);

        return view('home', ['articles' => $articles]);
    }

    /**
     * Галерея — все полные изображения.
     */
    public function gallery()
    {
        $json = file_get_contents(public_path('articles.json'));
        $articles = json_decode($json, true);

        return view('gallery', ['articles' => $articles]);
    }
}