<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use App\Data\CasesData;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $casesData = CasesData::all();
        
        foreach ($casesData as $case) {
            Project::create([
                'slug' => $case['slug'],
                'title' => $case['title'],
                'title_short' => $case['title_short'] ?? null,
                'category' => $case['category'] ?? null,
                'price' => $case['price'] ?? null,
                'duration' => $case['duration'] ?? null,
                'complexity' => $case['complexity'] ?? null,
                'client' => $case['client'] ?? null,
                'website' => $case['website'] ?? null,
                'has_logo' => $case['has_logo'] ?? false,
                'logo' => $case['logo'] ?? null,
                'logo_color' => $case['logo_color'] ?? null,
                'task' => $case['task'] ?? null,
                'tags' => $case['tags'] ?? null,
                'solution_text' => $case['solution_text'] ?? null,
                'solution_list' => $case['solution_list'] ?? null,
                'technologies' => $case['technologies'] ?? null,
                'results' => $case['results'] ?? null,
                'details' => $case['details'] ?? null,
                'result' => $case['result'] ?? null,
                'sort' => $case['id'] ?? 0,
                'is_active' => true,
            ]);
        }
    }
}
