@extends('layouts.app')

@section('title', 'Создание статьи')

@section('content')
    <div class="page" style="max-width: 600px; margin: 0 auto;">
        <h1>Создать статью</h1>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold;">Заголовок:</label>
                <input type="text" name="title" value="{{ old('title') }}" style="width: 100%; padding: 8px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold;">Краткое описание:</label>
                <textarea name="short_description" style="width: 100%; padding: 8px;" rows="3">{{ old('short_description') }}</textarea>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold;">Полный текст:</label>
                <textarea name="content" style="width: 100%; padding: 8px;" rows="5">{{ old('content') }}</textarea>
            </div>
            <button type="submit" style="background: #2d3748; color: white; padding: 10px 20px; border: none; cursor: pointer;">Сохранить</button>
            <a href="{{ route('home') }}" style="margin-left: 10px;">Отмена</a>
        </form>
    </div>
@endsection