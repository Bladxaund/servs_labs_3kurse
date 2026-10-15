@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Новости</h1>

    @foreach ($articles as $article)
        <article class="news-item">
            <h2>{{ $article['Название'] }}</h2>
            <p class="news-date">{{ $article['Дата'] }}</p>

            <a href="{{ route('gallery') }}">
                <img src="{{ asset($article['preview_image']) }}"
                     alt="{{ $article['Название'] }}"
                     class="news-preview">
            </a>

            <p class="news-short">{{ $article['Краткое описание'] }}</p>
        </article>
    @endforeach
@endsection