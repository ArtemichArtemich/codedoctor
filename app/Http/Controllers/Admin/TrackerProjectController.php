<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTrackerProjectRequest;
use App\Http\Requests\UpdateTrackerProjectRequest;
use App\Models\TrackerProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TrackerProjectController extends Controller
{
    public function index(): View
    {
        $projects = TrackerProject::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.tracker-projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.tracker-projects.create');
    }

    public function store(StoreTrackerProjectRequest $request): RedirectResponse
    {
        $project = TrackerProject::create($request->validated());

        return redirect()
            ->route('admin.tracker-projects.index')
            ->with('success', "Проект «{$project->title}» создан");
    }

    public function show(TrackerProject $trackerProject): View
    {
        return view('admin.tracker-projects.show', compact('trackerProject'));
    }

    public function edit(TrackerProject $trackerProject): View
    {
        return view('admin.tracker-projects.edit', compact('trackerProject'));
    }

    public function update(UpdateTrackerProjectRequest $request, TrackerProject $trackerProject): RedirectResponse
    {
        $trackerProject->update($request->validated());

        return redirect()
            ->route('admin.tracker-projects.index')
            ->with('success', "Проект «{$trackerProject->title}» обновлён");
    }

    public function destroy(TrackerProject $trackerProject): RedirectResponse
    {
        $title = $trackerProject->title;
        $trackerProject->delete();

        return redirect()
            ->route('admin.tracker-projects.index')
            ->with('success', "Проект «{$title}» удалён");
    }
}