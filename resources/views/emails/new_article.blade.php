<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Новая статья</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f6f8; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px;">
        <h2 style="color: #2d3748;">Опубликована новая статья!</h2>
        
        <p><strong>Дата публикации:</strong> {{ $article->published_at }}</p>
        
        <h3 style="color: #1abc9c;">{{ $article->title }}</h3>
        
        <p style="color: #555;">
            {{ $article->short_description }}
        </p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        
        <p style="font-size: 12px; color: #888;">
            Это автоматическое сообщение с сайта {{ config('app.name') }}.
        </p>
    </div>
</body>
</html>