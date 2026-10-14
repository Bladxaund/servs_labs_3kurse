<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мой сайт')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        header { background: #2d3748; padding: 15px 30px; }
        header nav a { color: #fff; margin-right: 20px; text-decoration: none; }
        header nav a:hover { text-decoration: underline; }
        main { padding: 30px; min-height: 400px; }
        footer { background: #edf2f7; padding: 15px 30px; text-align: center; color: #4a5568; }
    </style>
</head>
<body>

    <header>
        <nav>
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('about') }}">О нас</a>
            <a href="{{ route('contacts') }}">Контакты</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
     Каджардузов Роман Антонович, группа 251-3210
    </footer>

</body>
</html>
