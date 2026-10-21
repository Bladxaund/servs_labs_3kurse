@extends('layouts.app')

@section('title', 'Модерация комментариев')

@section('content')
    <div class="page">
        <h1>Модерация комментариев</h1>

        @if (session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($comments->isEmpty())
            <p>Нет комментариев, ожидающих модерации.</p>
        @else
            @foreach ($comments as $comment)
                <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 6px;">
                    <p><strong>Статья:</strong> {{ $comment->article->title }}</p>
                    <p><strong>Пользователь:</strong> {{ $comment->user->name }}</p>
                    <p style="background: #f9fafb; padding: 10px; border-left: 3px solid #3b82f6;">{{ $comment->body }}</p>
                    
                    <div style="margin-top: 10px;">
                        <form action="{{ route('comments.approve', $comment->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" style="background: #10b981; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;">Одобрить</button>
                        </form>

                        <form action="{{ route('comments.reject', $comment->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #ef4444; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer;">Отклонить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection