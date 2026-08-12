<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $cases = Project::where('is_active', true)
            ->orderBy('sort')
            ->limit(6)
            ->get();

        return view('pages.home', compact('cases'));
    }
}