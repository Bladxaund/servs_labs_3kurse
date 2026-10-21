<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Получить список статей (с пагинацией)
    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')->paginate(5);
        return response()->json($articles, 200);
    }

    // Создать новую статью
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        $validated['preview_image'] = 'preview.jpg'; 
        $validated['full_image'] = 'full.jpeg';
        $validated['published_at'] = date('Y-m-d');

        $article = Article::create($validated);

        return response()->json([
            'message' => 'Статья создана',
            'article' => $article
        ], 201);
    }

    // Получить одну статью
    public function show(Article $article)
    {
        return response()->json($article->load('comments'), 200);
    }

    // Обновить статью
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        $article->update($validated);

        return response()->json([
            'message' => 'Статья обновлена',
            'article' => $article
        ], 200);
    }

    // Удалить статью
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(['message' => 'Статья удалена'], 200);
    }
}