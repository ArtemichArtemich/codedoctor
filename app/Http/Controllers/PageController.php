<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
    
    public function services()
    {
        return view('pages.services');
    }
    
    public function cases()
    {
        $projects = Project::where('is_active', true)
                          ->orderBy('sort')
                          ->get();
        
        return view('pages.cases.index', ['cases' => $projects]);
    }
    
    public function prices()
    {
        return view('pages.prices');
    }
    
    public function about()
    {
        return view('pages.about');
    }
    
    public function contacts()
    {
        return view('pages.contacts');
    }
    
    // Новый метод для динамических страниц
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
                    ->where('is_active', true)
                    ->firstOrFail();
        
        return view('pages.dynamic', compact('page'));
    }
}