<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function read($id)
    {
        // Находим уведомление текущего пользователя
        $notification = Auth::user()->notifications()->findOrFail($id);
        
        // Помечаем как прочитанное
        $notification->markAsRead();

        // Перенаправляем на статью
        return redirect()->route('articles.show', $notification->data['article_id']);
    }
}