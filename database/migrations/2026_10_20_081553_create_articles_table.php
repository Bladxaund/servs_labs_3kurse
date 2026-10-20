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
        Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Название
        $table->text('short_description')->nullable(); // Краткое описание
        $table->text('content')->nullable(); // Полный текст
        $table->string('preview_image')->nullable(); // Превью
        $table->string('full_image')->nullable(); // Полная картинка
        $table->date('published_at')->nullable(); // Дата публикации
        $table->timestamps(); // created_at и updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
