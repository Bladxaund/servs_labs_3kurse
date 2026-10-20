@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Новости</h1>

    @foreach ($articles as $article)
        <article class="news-item">
            {{-- Обратите внимание: обращаемся через -> --}}
            <h2>{{ $article->title }}</h2>
            <p class="news-date">{{ $article->published_at }}</p>

            <a href="{{ route('gallery') }}">
                <img src="{{ asset($article->preview_image) }}"
                     alt="{{ $article->title }}"
                     class="news-preview">
            </a>

            <p class="news-short">{{ $article->short_description }}</p>
        </article>
    @endforeach
@endsection