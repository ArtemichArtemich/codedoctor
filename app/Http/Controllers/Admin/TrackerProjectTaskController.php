<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskPriority;
use App\Models\TaskStatus;
use App\Models\TrackerProject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TrackerProjectTaskController extends Controller
{
    public function index(TrackerProject $trackerProject): View
    {
        $tasks = $trackerProject->tasks()
            ->with(['status', 'priority', 'assignedTo'])
            ->orderBy('sort')
            ->get();

        return view('admin.tasks.index', compact('trackerProject', 'tasks'));
    }

    public function create(TrackerProject $trackerProject): View
    {
        $statuses = TaskStatus::orderBy('sort')->get();
        $priorities = TaskPriority::orderBy('sort')->get();
        $users = User::orderBy('name')->get();

        return view('admin.tasks.create', compact('trackerProject', 'statuses', 'priorities', 'users'));
    }

    public function store(StoreTaskRequest $request, TrackerProject $trackerProject): RedirectResponse
    {
        $data = $request->validated();
        $data['tracker_project_id'] = $trackerProject->id;
        $data['created_by'] = auth()->id();

        $task = Task::create($data);

        return redirect()
            ->route('admin.tracker-projects.tasks.index', $trackerProject)
            ->with('success', "Задача «{$task->title}» создана");
    }

    public function edit(TrackerProject $trackerProject, Task $task): View
    {
        $this->ensureTaskBelongsToProject($trackerProject, $task);

        $statuses = TaskStatus::orderBy('sort')->get();
        $priorities = TaskPriority::orderBy('sort')->get();
        $users = User::orderBy('name')->get();

        return view('admin.tasks.edit', compact('trackerProject', 'task', 'statuses', 'priorities', 'users'));
    }

    public function update(UpdateTaskRequest $request, TrackerProject $trackerProject, Task $task): RedirectResponse
    {
        $this->ensureTaskBelongsToProject($trackerProject, $task);

        $task->update($request->validated());

        return redirect()
            ->route('admin.tracker-projects.tasks.index', $trackerProject)
            ->with('success', "Задача «{$task->title}» обновлена");
    }

    public function destroy(TrackerProject $trackerProject, Task $task): RedirectResponse
    {
        $this->ensureTaskBelongsToProject($trackerProject, $task);

        $title = $task->title;
        $task->delete();

        return redirect()
            ->route('admin.tracker-projects.tasks.index', $trackerProject)
            ->with('success', "Задача «{$title}» удалена");
    }

    private function ensureTaskBelongsToProject(TrackerProject $trackerProject, Task $task): void
    {
        abort_unless($task->tracker_project_id === $trackerProject->id, 404);
    }
}
