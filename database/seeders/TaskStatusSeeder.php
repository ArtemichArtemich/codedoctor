<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'todo',
                'label' => 'To Do',
                'color' => 'gray',
                'sort' => 1,
                'is_default' => true,
            ],
            [
                'name' => 'in_progress',
                'label' => 'In Progress',
                'color' => 'blue',
                'sort' => 2,
                'is_default' => false,
            ],
            [
                'name' => 'review',
                'label' => 'Review',
                'color' => 'orange',
                'sort' => 3,
                'is_default' => false,
            ],
            [
                'name' => 'done',
                'label' => 'Done',
                'color' => 'green',
                'sort' => 4,
                'is_default' => false,
            ],
        ];

        foreach ($statuses as $status) {
            TaskStatus::updateOrCreate(
                ['name' => $status['name']],
                $status
            );
        }
    }
}