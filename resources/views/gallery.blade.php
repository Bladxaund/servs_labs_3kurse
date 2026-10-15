@extends('layouts.app')

@section('title', 'Галерея')

@section('content')
    <h1>Галерея</h1>

    <div class="gallery-grid">
        @foreach ($articles as $article)
            <div class="gallery-item">
                <img src="{{ asset($article['full_image']) }}"
                     alt="{{ $article['Название'] }}"
                     class="gallery-full">
                <p class="gallery-caption">{{ $article['Название'] }}</p>
            </div>
        @endforeach
    </div>
@endsection