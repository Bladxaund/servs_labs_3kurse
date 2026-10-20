<?php

namespace App\Http\Controllers;

use App\Models\Article; // <-- Добавить
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        // Получаем все статьи, сортируя по дате (сначала новые)
        $articles = Article::orderBy('published_at', 'desc')->get();
        
        // Передаем в представление
        return view('home', ['articles' => $articles]);
    }
}
