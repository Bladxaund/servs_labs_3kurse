<?php

namespace App\Jobs;

use App\Mail\NewArticleNotification;
use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $article;

    // Передаем статью в задание
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    // Этот метод выполнится в фоне
    public function handle(): void
    {
        // Отправляем письмо
        Mail::to('student_serv_labs@mail.ru')->send(new NewArticleNotification($this->article));
    }
}