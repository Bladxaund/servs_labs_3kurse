<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Создаем роли
        $moderatorRole = Role::create(['name' => 'moderator', 'title' => 'Модератор']);
        $readerRole = Role::create(['name' => 'reader', 'title' => 'Читатель']);

        // 2. Создаем модератора (email: moderator@example.com / password: password)
        User::create([
            'name' => 'Модератор',
            'email' => 'moderator@example.com',
            'password' => bcrypt('password'),
            'role_id' => $moderatorRole->id,
        ]);

        // 3. Создаем обычного читателя (email: reader@example.com / password: password)
        User::create([
            'name' => 'Читатель',
            'email' => 'reader@example.com',
            'password' => bcrypt('password'),
            'role_id' => $readerRole->id,
        ]);

        // 4. Создаем новости
        Article::factory(10)->create();
    }
}