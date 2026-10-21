<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Jobs\VeryLongJob; // Из 10-й лабы
use App\Notifications\NewArticleNotification; // Из 12-й лабы
use Illuminate\Support\Facades\Notification; // Из 12-й лабы

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

        // 1. Сохраняем статью
        $article = Article::create($validated);

        // 2. Ставим в очередь отправку письма (10-я лаба)
        // VeryLongJob::dispatch($article); 

        // 3. Отправляем уведомление в базу данных Читателям (12-я лаба)
        $readers = User::whereHas('role', function ($query) {
            $query->where('name', 'reader');
        })->get();

        Notification::send($readers, new NewArticleNotification($article));

        return redirect()->route('home')->with('success', 'Статья успешно создана!');
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