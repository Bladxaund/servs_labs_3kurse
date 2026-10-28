<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache; // Для 13-й лабы

class CommentController extends Controller
{
    // Добавление комментария (9-я лаба)
    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $article->comments()->create([
            'user_id' => Auth::id(),
            'body' => $validated['body'],
            'is_approved' => false, 
        ]);

        return back()->with('success', 'Ваш комментарий отправлен на модерацию!');
    }

    // Панель модератора (9-я лаба)
    public function moderate()
    {
        if (!Auth::user()->role || Auth::user()->role->name !== 'moderator') {
            abort(403, 'Доступ запрещен.');
        }
        $comments = Comment::where('is_approved', false)->orderBy('created_at', 'desc')->get();
        return view('comments.moderate', compact('comments'));
    }

    // Одобрение (9-я лаба)
    public function approve(Comment $comment)
    {
        if (!Auth::user()->role || Auth::user()->role->name !== 'moderator') {
            abort(403);
        }
        $comment->update(['is_approved' => true]);
        Cache::forget('article_' . $comment->article_id); 
        return back()->with('success', 'Комментарий одобрен!');
    }

    // Отклонение (9-я лаба)
    public function reject(Comment $comment)
    {
        if (!Auth::user()->role || Auth::user()->role->name !== 'moderator') {
            abort(403);
        }
        $articleId = $comment->article_id;
        $comment->delete();
        Cache::forget('article_' . $articleId); 
        return back()->with('success', 'Комментарий отклонен и удален.');
    }

    // --- ДОМАШНЕЕ ЗАДАНИЕ №3 и №4: CRUD ---

    // Форма редактирования
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment); // Проверка через Политику
        return view('comments.edit', compact('comment'));
    }

    // Сохранение изменений
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment); // Проверка через Политику
        
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update($validated);
        
        Cache::forget('article_' . $comment->article_id);

        return redirect()->route('articles.show', $comment->article_id)
                         ->with('success', 'Комментарий обновлен!');
    }

    // Удаление комментария
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment); // Проверка через Политику
        
        $articleId = $comment->article_id;
        $comment->delete();
        
        Cache::forget('article_' . $articleId);

        return redirect()->route('articles.show', $articleId)
                         ->with('success', 'Комментарий удален!');
    }
}