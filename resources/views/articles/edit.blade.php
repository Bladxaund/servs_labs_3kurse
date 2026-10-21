@extends('layouts.app')

@section('title', 'Редактирование статьи')

@section('content')
    <div class="page" style="max-width: 600px; margin: 40px auto; padding: 30px; box-sizing: border-box;">
        <h1 style="text-align: center; margin-top: 0; margin-bottom: 25px;">Редактировать статью</h1>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label for="title" style="display: block; margin-bottom: 8px; font-weight: bold; color: #2d3748;">Заголовок:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required 
                       style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="short_description" style="display: block; margin-bottom: 8px; font-weight: bold; color: #2d3748;">Краткое описание:</label>
                <textarea name="short_description" id="short_description" rows="3" 
                          style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit;">{{ old('short_description', $article->short_description) }}</textarea>
            </div>

            <div style="margin-bottom: 25px;">
                <label for="content" style="display: block; margin-bottom: 8px; font-weight: bold; color: #2d3748;">Полный текст:</label>
                <textarea name="content" id="content" rows="6" 
                          style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit;">{{ old('content', $article->content) }}</textarea>
            </div>

            <div style="display: flex; align-items: center; gap: 15px;">
                <button type="submit" style="background: #2d3748; color: white; padding: 12px 25px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">
                    Обновить статью
                </button>
                <a href="{{ route('home') }}" style="color: #4a5568; text-decoration: none;">Отмена</a>
            </div>
        </form>
    </div>
@endsection