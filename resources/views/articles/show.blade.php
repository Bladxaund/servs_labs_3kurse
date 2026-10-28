@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="page">
        <h1 style="margin-bottom: 5px;">{{ $article->title }}</h1>
        <p style="color: #888; margin-top: 0; margin-bottom: 20px;">{{ $article->published_at }}</p>
        
        <div style="margin-bottom: 30px; line-height: 1.6; font-size: 16px; color: #333;">
            {{ $article->content }}
        </div>
        
        <a href="{{ route('home') }}" style="color: #3182ce; text-decoration: none; font-weight: bold;">← Назад к новостям</a>

        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 30px 0;">

        <h3 style="color: #2d3748; margin-bottom: 20px;">Комментарии</h3>

        @if (session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 6px; margin-bottom: 20px; border-left: 4px solid #10b981;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Вывод комментариев из переменной $article (кешируется в контроллере) --}}
        @forelse ($article->comments as $comment)
            <div style="background: #f8fafc; padding: 15px 20px; border-radius: 8px; margin-bottom: 15px; border: 1px solid #e2e8f0;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <div>
                        <strong style="color: #2d3748;">{{ $comment->user->name }}</strong> 
                        <span style="color: #a0aec0; font-size: 12px; margin-left: 10px;">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    
                    {{-- Кнопки управления (только для авторизованных) --}}
                    @auth
                        <div>
                            <a href="{{ route('comments.edit', $comment->id) }}" style="color: #f59e0b; text-decoration: none; margin-right: 15px; font-size: 14px;">Редактировать</a>
                            
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 14px; padding: 0;" onclick="return confirm('Вы уверены, что хотите удалить комментарий?')">Удалить</button>
                            </form>
                        </div>
                    @endauth
                </div>
                <p style="margin: 0; color: #4a5568; line-height: 1.5;">{{ $comment->body }}</p>
            </div>
        @empty
            <p style="color: #a0aec0; font-style: italic; margin-bottom: 20px;">Пока нет одобренных комментариев. Будьте первым!</p>
        @endforelse

        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 30px 0;">

        {{-- Форма добавления комментария --}}
        @auth
            <div style="background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
                <h4 style="margin-top: 0; margin-bottom: 15px; color: #2d3748;">Оставить комментарий</h4>
                <form action="{{ route('comments.store', $article->id) }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 15px;">
                        <textarea name="body" rows="4" required placeholder="Напишите ваш комментарий здесь..." 
                                  style="width: 100%; box-sizing: border-box; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit; font-size: 15px; resize: vertical;"
                                  onfocus="this.style.borderColor='#3182ce'; this.style.boxShadow='0 0 0 3px rgba(49,130,206,0.1)'"
                                  onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"></textarea>
                    </div>
                    <button type="submit" style="background: #2d3748; color: white; padding: 12px 25px; border: none; border-radius: 6px; cursor: pointer; font-size: 15px; font-weight: bold;" onmouseover="this.style.background='#1a202c'" onmouseout="this.style.background='#2d3748'">
                        Отправить
                    </button>
                </form>
            </div>
        @else
            <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; text-align: center;">
                <p style="color: #4a5568; margin: 0;">
                    <a href="{{ route('login') }}" style="color: #3182ce; text-decoration: none; font-weight: bold;">Войдите</a>, чтобы оставить комментарий.
                </p>
            </div>
        @endauth
    </div>
@endsection