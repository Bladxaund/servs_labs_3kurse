<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Mail\NewArticleNotification; // Для Лабы 8
use Illuminate\Support\Facades\Mail; // Для Лабы 8
use App\Jobs\VeryLongJob;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')->paginate(5);
        return view('home', ['articles' => $articles]);
    }

    public function create()
    {
        $this->authorize('create', Article::class);
        return view('articles.create');
    }

    // 5. Вызов метода send после сохранения в БД
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

        // Сохраняем статью
        $article = Article::create($validated);

        // ВМЕСТО Mail::to(...) ВЫЗЫВАЕМ ЗАДАНИЕ В ОЧЕРЕДЬ (dispatch)
        VeryLongJob::dispatch($article);

        return redirect()->route('home')->with('success', 'Статья создана, письмо отправлено в очередь!');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
        ]);

        $article->update($validated);

        return redirect()->route('home')->with('success', 'Статья успешно обновлена!');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        
        $article->delete();
        return redirect()->route('home')->with('success', 'Статья удалена!');
    }
}