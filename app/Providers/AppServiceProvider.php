<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 5-я лаба (Пагинация)
        Paginator::useBootstrapFour();

        // 7-я лаба (Шлюз для комментариев)
        Gate::define('write-comment', function (User $user) {
            return $user->role && $user->role->name === 'moderator';
        });

        // ДЗ 4 (Шлюз: создание комментариев)
        Gate::define('create-comment', function (User $user) {
            return $user->role && in_array($user->role->name, ['reader', 'moderator']);
        });

        // 7-я лаба (Политика статей)
        Gate::policy(Article::class, ArticlePolicy::class);

        // ДЗ 3 и 4 (Политика комментариев)
        Gate::policy(Comment::class, CommentPolicy::class);
    }
}