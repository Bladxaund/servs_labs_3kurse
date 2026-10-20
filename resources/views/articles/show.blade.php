@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="page">
        <h1>{{ $article->title }}</h1>
        <p style="color: #888;">{{ $article->published_at }}</p>
        <p>{{ $article->short_description }}</p>
        <div>{{ $article->content }}</div>
        <br>
        <a href="{{ route('home') }}">← Назад к новостям</a>
    </div>
@endsection