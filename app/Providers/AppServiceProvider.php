<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Article;
use App\Policies\ArticlePolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Из 5-й лабы (стили пагинации)
        Paginator::useBootstrapFour();

        // 2. Из 7-й лабы (Шлюз для комментариев)
        Gate::define('write-comment', function (User $user) {
            return $user->role && $user->role->name === 'moderator';
        });

        // 3. КРИТИЧЕСКИ ВАЖНО: Привязка Политики к Модели (чтобы не было 404)
        Gate::policy(Article::class, ArticlePolicy::class);
    }
}