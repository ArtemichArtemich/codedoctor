<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Сначала создаём статусы и приоритеты
        $this->call([
            TaskStatusSeeder::class,
            TaskPrioritySeeder::class,
        ]);

        // 2. Потом создаём тестового пользователя (опционально)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}