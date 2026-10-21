<?php

namespace App\Http\Middleware;

use App\Models\View;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackViews
{
    public function handle(Request $request, Closure $next): Response
    {
        // Сохраняем просмотр (п. 1 задания)
        $article = $request->route('article');
        
        if ($article) {
            View::create([
                'article_id' => $article->id,
                'ip_address' => $request->ip(),
            ]);
        }

        return $next($request);
    }
}