<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    // Может ли пользователь создавать статьи? (Только модератор)
    public function create(User $user): bool
    {
        return $user->role && $user->role->name === 'moderator';
    }

    // Может ли редактировать/удалять? (Только модератор)
    public function update(User $user, Article $article): bool
    {
        return $user->role && $user->role->name === 'moderator';
    }

    public function delete(User $user, Article $article): bool
    {
        return $user->role && $user->role->name === 'moderator';
    }
}