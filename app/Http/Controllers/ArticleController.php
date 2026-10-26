<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User; // Для уведомлений
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; // Для 13-й лабы (Кеш)
use Illuminate\Support\Facades\Notification; // Для 12-й лабы (Уведомления)
use App\Notifications\NewArticleNotification; // Для 12-й лабы
use App\Events\NewArticleEvent;

class ArticleController extends Controller
{
    // 4. Кешируем данные главной страницы с учетом пагинации
    public function index()
    {
        $page = request('page', 1); // Получаем номер текущей страницы (по умолчанию 1)
        $cacheKey = 'articles_page_' . $page;

        // remember сохраняет данные в кеш на 3600 секунд (1 час)
        $articles = Cache::remember($cacheKey, 3600, function () {
            return Article::orderBy('published_at', 'desc')->paginate(5);
        });

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

        // 2. Отправляем уведомления читателям (Лаба 12)
        $readers = User::whereHas('role', function ($query) {
            $query->where('name', 'reader');
        })->get();
        Notification::send($readers, new NewArticleNotification($article));

        // 3. ОТПРАВЛЯЕМ СОБЫТИЕ В PUSHER (Лаба 11)
        event(new NewArticleEvent($article));

        // 4. УДАЛЯЕМ КЕШ ГЛАВНОЙ СТРАНИЦЫ (Лаба 13)
        Cache::forget('articles_page_1');

        return redirect()->route('home')->with('success', 'Статья успешно создана!');
    }

    // 6. Кешируем данные страницы просмотра статьи, включая комментарии
    public function show(Article $article)
    {
        // rememberForever хранит кеш бессрочно
        $cachedArticle = Cache::rememberForever('article_' . $article->id, function () use ($article) {
            // Загружаем одобренные комментарии вместе с их авторами
            return $article->load(['comments' => function($query) {
                $query->where('is_approved', true)->with('user');
            }]);
        });

        return view('articles.show', ['article' => $cachedArticle]);
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

        // 7. ОЧИЩАЕМ ВЕСЬ КЕШ (Лаба 13, п. 7)
        Cache::flush();

        return redirect()->route('home')->with('success', 'Статья успешно обновлена!');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        
        $article->delete();

        // 7. ОЧИЩАЕМ ВЕСЬ КЕШ (Лаба 13, п. 7)
        Cache::flush();

        return redirect()->route('home')->with('success', 'Статья удалена!');
    }
}