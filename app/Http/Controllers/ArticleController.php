<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')->paginate(5);
        return view('home', ['articles' => $articles]);
    }

    public function create()
    {
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

        Article::create($validated);

        return redirect()->route('home')->with('success', 'Статья успешно создана!');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
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
        $article->delete();
        return redirect()->route('home')->with('success', 'Статья удалена!');
    }
}