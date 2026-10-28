<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory; // <-- ЭТА СТРОКА ДОЛЖНА БЫТЬ ЗДЕСЬ, ВНУТРИ КЛАССА (один раз)

    protected $fillable = ['article_id', 'user_id', 'body', 'is_approved'];

    // Связь со статьей
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // Связь с пользователем
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}