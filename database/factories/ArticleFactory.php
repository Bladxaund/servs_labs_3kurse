<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'title' => fake()->sentence(4), // Случайное предложение из 4 слов
        'short_description' => fake()->sentence(10),
        'content' => fake()->paragraphs(3, true), // 3 абзаца текста
        // Используем заглушки для картинок
        'preview_image' => 'preview.jpg', 
        'full_image' => 'full.jpeg',
        // Генерируем случайную дату за последний год
        'published_at' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
    ];
}
}
