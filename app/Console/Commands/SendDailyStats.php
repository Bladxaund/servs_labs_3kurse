<?php

namespace App\Console\Commands;

use App\Models\View;
use App\Models\Comment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyStatsNotification; // Мы создадим этот класс ниже

class SendDailyStats extends Command
{
    protected $signature = 'stats:send';
    protected $description = 'Отправка статистики модератору';

    public function handle()
    {
        // Считаем просмотры за сегодня (п. 2 задания)
        $viewsCount = View::whereDate('created_at', today())->count();
        
        // Считаем комментарии за сегодня (п. 2 задания)
        $commentsCount = Comment::whereDate('created_at', today())->count();

        // Отправляем данные на почту модератору
        Mail::to('moderator@example.com')->send(new DailyStatsNotification($viewsCount, $commentsCount));

        $this->info('Статистика отправлена!');
    }
}