@extends('layouts.app')

@section('title', 'Редактирование комментария')

@section('content')
    <div class="page" style="max-width: 600px; margin: 40px auto; padding: 30px; box-sizing: border-box;">
        <h1 style="text-align: center; margin-top: 0; margin-bottom: 25px;">Редактировать комментарий</h1>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 20px;">
                <label for="body" style="display: block; margin-bottom: 8px; font-weight: bold; color: #2d3748;">Текст комментария:</label>
                <textarea name="body" id="body" rows="5" required 
                          style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #cbd5e1; border-radius: 4px; font-family: inherit;">{{ old('body', $comment->body) }}</textarea>
            </div>

            <div style="display: flex; align-items: center; gap: 15px;">
                <button type="submit" style="background: #2d3748; color: white; padding: 12px 25px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;">
                    Обновить
                </button>
                <a href="{{ route('articles.show', $comment->article_id) }}" style="color: #4a5568; text-decoration: none;">Отмена</a>
            </div>
        </form>
    </div>
@endsection