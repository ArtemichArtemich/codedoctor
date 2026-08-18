<?php

namespace Database\Seeders;

use App\Models\TaskPriority;
use Illuminate\Database\Seeder;

class TaskPrioritySeeder extends Seeder
{
    public function run(): void
    {
        $priorities = [
            ['name' => 'low', 'label' => 'Low', 'color' => 'gray', 'sort' => 1],
            ['name' => 'medium', 'label' => 'Medium', 'color' => 'blue', 'sort' => 2],
            ['name' => 'high', 'label' => 'High', 'color' => 'orange', 'sort' => 3],
            ['name' => 'critical', 'label' => 'Critical', 'color' => 'red', 'sort' => 4],
        ];

        foreach ($priorities as $priority) {
            TaskPriority::updateOrCreate(
                ['name' => $priority['name']],
                $priority
            );
        }
    }
}