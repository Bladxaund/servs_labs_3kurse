<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Из 5-й лабы (стили пагинации)
        Paginator::useBootstrapFour();

        // Из 7-й лабы (Шлюз для комментариев)
        Gate::define('write-comment', function (User $user) {
            return $user->role && $user->role->name === 'moderator';
        });
    }
}