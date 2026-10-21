@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="page">
        <h1>{{ $article->title }}</h1>
        <p style="color: #888;">{{ $article->published_at }}</p>
        <div style="margin-bottom: 30px;">{{ $article->content }}</div>
        
        <a href="{{ route('home') }}">← Назад к новостям</a>

        <hr style="margin: 40px 0;">

        <h3>Комментарии</h3>

        {{-- Сообщение об отправке на модерацию (п. 4) --}}
        @if (session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Вывод только одобренных комментариев (п. 5) --}}
        @foreach ($article->comments()->where('is_approved', true)->get() as $comment)
            <div style="background: #f9fafb; padding: 15px; border-radius: 6px; margin-bottom: 10px;">
                <strong>{{ $comment->user->name }}</strong> <span style="color: #888; font-size: 12px;">({{ $comment->created_at->format('d.m.Y H:i') }})</span>
                <p style="margin-top: 5px;">{{ $comment->body }}</p>
            </div>
        @endforeach

        <hr style="margin: 20px 0;">

        {{-- Форма добавления комментария --}}
        @auth
            <form action="{{ route('comments.store', $article->id) }}" method="POST">
                @csrf
                <div style="margin-bottom: 10px;">
                    <textarea name="body" rows="3" required placeholder="Ваш комментарий..." style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
                </div>
                <button type="submit" style="background: #2d3748; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Отправить</button>
            </form>
        @else
            <p><a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.</p>
        @endauth
    </div>
@endsection