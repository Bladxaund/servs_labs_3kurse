<?php

namespace App\Mail;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewArticleNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $article;

    // 3. Передаем объект статьи в конструктор
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    // 3. Реализуем метод build (в новых версиях Laravel он называется envelope + content)
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Добавлена новая статья: ' . $this->article->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new_article',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}