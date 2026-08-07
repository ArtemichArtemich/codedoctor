<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    public function show($slug)
    {
        // Ищем проект по slug
        $case = Project::where('slug', $slug)
                       ->where('is_active', true)
                       ->firstOrFail();
        
        // Получаем предыдущий и следующий кейс для навигации
        $prevCase = Project::where('sort', '<', $case->sort)
                          ->where('is_active', true)
                          ->orderBy('sort', 'desc')
                          ->first();
        
        $nextCase = Project::where('sort', '>', $case->sort)
                          ->where('is_active', true)
                          ->orderBy('sort')
                          ->first();
        
        return view('pages.cases.show', compact('case', 'prevCase', 'nextCase'));
    }
}