<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyStatsNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $viewsCount;
    public $commentsCount;

    public function __construct($viewsCount, $commentsCount)
    {
        $this->viewsCount = $viewsCount;
        $this->commentsCount = $commentsCount;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ежедневная статистика сайта',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.daily_stats',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}