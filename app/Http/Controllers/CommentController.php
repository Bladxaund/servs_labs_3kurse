<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // 3. Добавление комментария (для авторизованных)
    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Создаем комментарий. По умолчанию is_approved = false (ждет модерации)
        $article->comments()->create([
            'user_id' => Auth::id(),
            'body' => $validated['body'],
            'is_approved' => false, 
        ]);

        // 4. Выводим сообщение о том, что комментарий ожидает модерации
        return back()->with('success', 'Ваш комментарий отправлен на модерацию!');
    }

    // 2. Панель модератора (только для модераторов)
    public function moderate()
    {
        // Проверка, что зашел именно модератор (можно через Policy или Gate)
        if (!Auth::user()->role || Auth::user()->role->name !== 'moderator') {
            abort(403, 'Доступ запрещен.');
        }

        // Берем ТОЛЬКО неодобренные комментарии
        $comments = Comment::where('is_approved', false)->orderBy('created_at', 'desc')->get();

        return view('comments.moderate', compact('comments'));
    }

    // 3. Одобрение комментария
    public function approve(Comment $comment)
    {
        if (!Auth::user()->role || Auth::user()->role->name !== 'moderator') {
            abort(403);
        }

        $comment->update(['is_approved' => true]);
        return back()->with('success', 'Комментарий одобрен!');
    }

    // 3. Отклонение (удаление) комментария
    public function reject(Comment $comment)
    {
        if (!Auth::user()->role || Auth::user()->role->name !== 'moderator') {
            abort(403);
        }

        $comment->delete();
        return back()->with('success', 'Комментарий отклонен и удален.');
    }
}