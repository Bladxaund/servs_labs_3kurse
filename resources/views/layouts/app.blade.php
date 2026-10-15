<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Мой сайт')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f6f8; }
        header { background: #2d3748; padding: 15px 30px; }
        header nav a { color: #fff; margin-right: 20px; text-decoration: none; }
        header nav a:hover { text-decoration: underline; }
        main { padding: 30px; min-height: 400px; max-width: 1000px; margin: 0 auto; }
        footer { background: #edf2f7; padding: 15px 30px; text-align: center; color: #4a5568; }

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
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('about') }}">О нас</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            <a href="{{ route('gallery') }}">Галерея</a>
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