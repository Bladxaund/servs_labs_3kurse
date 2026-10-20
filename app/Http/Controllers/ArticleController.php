<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // 1. Чтение (Список с пагинацией)
    public function index()
    {
        // Пагинация: по 5 статей на страницу
        $articles = Article::orderBy('published_at', 'desc')->paginate(5);
        return view('home', ['articles' => $articles]);
    }

    // 1. Создание (Форма)
    public function create()
    {
        return view('articles.create');
    }

    // 1. Создание (Сохранение)
    public function store(Request $request)
    {
        // 4. Валидация
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        // Заполняем остальные поля для БД
        $validated['preview_image'] = 'preview.jpg'; 
        $validated['full_image'] = 'full.jpeg';
        $validated['published_at'] = date('Y-m-d');

        Article::create($validated);

        return redirect()->route('home')->with('success', 'Статья успешно создана!');
    }

    // 2. Просмотр одной статьи
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // 2. Редактирование (Форма)
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    // 2. Редактирование (Сохранение)
    public function update(Request $request, Article $article)
    {
        // 4. Валидация
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        $article->update($validated);

        return redirect()->route('home')->with('success', 'Статья успешно обновлена!');
    }

    // 3. Удаление
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('home')->with('success', 'Статья удалена!');
    }
}