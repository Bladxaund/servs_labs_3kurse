<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            
            // Внешний ключ на статью. Если статью удалят, комментарии тоже удалятся (onDelete('cascade'))
            $table->foreignId('article_id')->constrained()->onDelete('cascade'); 
            
            // Внешний ключ на пользователя, который оставил комментарий
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // Текст комментария
            $table->text('body'); 
            
            // Поле для модерации (по умолчанию false - ожидает проверки)
            $table->boolean('is_approved')->default(false); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};