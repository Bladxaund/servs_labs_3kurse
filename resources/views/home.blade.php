@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="margin: 0;">Новости</h1>
        
        {{-- Показываем кнопку "Добавить" ТОЛЬКО модератору --}}
        @can('create', App\Models\Article::class)
            <a href="{{ route('articles.create') }}" style="background: #1abc9c; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">+ Добавить статью</a>
        @endcan
    </div>

    @if (session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($articles as $article)
        <article class="news-item">
            <h2>{{ $article->title }}</h2>
            <p class="news-date">{{ $article->published_at }}</p>

            <a href="{{ route('gallery') }}">
                <img src="{{ asset($article->preview_image) }}" alt="{{ $article->title }}" class="news-preview">
            </a>

            <p class="news-short">{{ $article->short_description }}</p>
            
            <div style="margin-top: 15px;">
                <a href="{{ route('articles.show', $article->id) }}" style="margin-right: 10px; color: #2d3748;">Читать</a>
                
                {{-- Кнопки управления только для модератора --}}
                @can('update', $article)
                    <a href="{{ route('articles.edit', $article->id) }}" style="margin-right: 10px; color: #f59e0b;">Редактировать</a>
                @endcan
                
                @can('delete', $article)
                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 0;" onclick="return confirm('Вы уверены?')">Удалить</button>
                    </form>
                @endcan
            </div>
        </article>
    @endforeach

    <div style="margin-top: 30px;">
        {{ $articles->links() }}
    </div>
@endsection