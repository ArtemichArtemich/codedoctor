<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Project;

class PageController extends Controller
{
    /**
     * Страница со списком кейсов.
     */
    public function cases()
    {
        $projects = Project::where('is_active', true)
            ->orderBy('sort')
            ->get();

        return view('pages.cases.index', [
            'cases' => $projects,
        ]);
    }


    /**
     * Динамические страницы из БД.
     */
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.dynamic', compact('page'));
    }
}