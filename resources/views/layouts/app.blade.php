<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Мой сайт')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f6f8; }
        header { background: #2d3748; padding: 15px 30px; }
        header nav a { color: #fff; margin-right: 20px; text-decoration: none; font-size: 16px; }
        header nav a:hover { text-decoration: underline; }
        main { padding: 30px; min-height: 400px; max-width: 1000px; margin: 0 auto; }
        footer { background: #edf2f7; padding: 15px 30px; text-align: center; color: #4a5568; margin-top: 40px; }

        .page { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,.05); }
        .page h1 { color: #2d3748; margin-top: 0; }

        .news-item { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,.05); margin-bottom: 25px; }
        .news-item h2 { color: #2d3748; margin: 0 0 8px; }
        .news-date { color: #888; font-size: 14px; margin: 0 0 15px; }
        .news-preview { max-width: 320px; width: 100%; border-radius: 6px; display: block; margin-bottom: 15px; transition: transform .2s; }
        .news-preview:hover { transform: scale(1.03); }
        .news-short { color: #555; line-height: 1.6; margin: 0; }

        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 20px; }
        .gallery-item { background: #fff; padding: 12px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,.05); }
        .gallery-full { width: 100%; height: 200px; object-fit: cover; border-radius: 6px; display: block; }
        .gallery-caption { margin-top: 10px; font-size: 14px; color: #2d3748; text-align: center; }

        .contacts-list { list-style: none; padding: 0; }
        .contacts-list li { padding: 12px 15px; border-left: 4px solid #1abc9c; background: #f9fafb; margin-bottom: 10px; border-radius: 4px; }

        .pagination { display: flex; padding-left: 0; list-style: none; border-radius: .25rem; margin-top: 20px; gap: 5px; }
        .page-link { position: relative; display: block; padding: .5rem .75rem; line-height: 1.25; color: #2d3748; background-color: #fff; border: 1px solid #dee2e6; text-decoration: none; border-radius: 4px; }
        .page-link:hover { z-index: 2; color: #1a202c; background-color: #e9ecef; }
        .page-item.active .page-link { z-index: 3; color: #fff; background-color: #2d3748; border-color: #2d3748; }

        /* Стили для выпадающего меню уведомлений */
        #notif-dropdown.show { display: block !important; }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('about') }}">О нас</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            <a href="{{ route('gallery') }}">Галерея</a>

            @auth
                {{-- Ссылка на модерацию видна ТОЛЬКО модератору (Лаба 9) --}}
                @if(auth()->user()->role && auth()->user()->role->name === 'moderator')
                    <a href="{{ route('comments.moderate') }}" style="color: #fbbf24;">Модерация</a>
                @endif

                {{-- Колокольчик с уведомлениями (Лаба 12) --}}
                <div style="display: inline-block; position: relative; margin-right: 20px;">
                    <span style="color: #fff; cursor: pointer;" onclick="document.getElementById('notif-dropdown').classList.toggle('show')">
                        🔔 Уведомления 
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span style="background: #ef4444; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </span>
                    
                    <div id="notif-dropdown" style="display: none; position: absolute; top: 100%; right: 0; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 6px; width: 300px; z-index: 1000; max-height: 400px; overflow-y: auto;">
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <a href="{{ route('notifications.read', $notification->id) }}" style="display: block; padding: 10px 15px; border-bottom: 1px solid #eee; color: #333; text-decoration: none; font-size: 14px;">
                                {{ $notification->data['message'] }}
                            </a>
                        @empty
                            <div style="padding: 15px; color: #888; text-align: center;">Нет новых уведомлений</div>
                        @endforelse
                    </div>
                </div>

                <span style="color: #a0aec0; margin-right: 20px; margin-left: 20px;">Привет, {{ auth()->user()->name }}!</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #fc8181; cursor: pointer; font-size: 16px;">Выйти</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('register') }}">Регистрация</a>
                <a href="{{ route('login') }}">Вход</a>
            @endguest
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Каджарузов Роман, группа 251-3210</p>
        <p>&copy; {{ date('Y') }} Все права защищены</p>
    </footer>
</body>
</html>