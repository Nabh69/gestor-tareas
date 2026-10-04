<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $tasks = $this->taskService->getAll();

        $projects = Project::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('tasks.index', compact(
            'tasks',
            'projects'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',

            'description' => 'nullable|string|max:1000',

            'priority' => 'required|in:baja,media,alta',

            'due_date' => 'nullable|date',

            'project_id' => [
                'nullable',
                Rule::exists('projects', 'id')
                    ->where(function ($query) {
                        $query->where(
                            'user_id',
                            auth()->id()
                        );
                    }),
            ],
        ]);

        $this->taskService->create($data);

        return redirect()
            ->route('tasks.index')
            ->with(
                'success',
                'Tarea creada correctamente.'
            );
    }

    public function edit(Task $task)
    {
        $this->taskService->validateOwner($task);

        $projects = Project::where(
            'user_id',
            auth()->id()
        )
        ->orderBy('name')
        ->get();

        return view(
            'tasks.edit',
            compact(
                'task',
                'projects'
            )
        );
    }

    public function update(
        Request $request,
        Task $task
    ) {
        $data = $request->validate([
            'title' => 'required|string|max:150',

            'description' => 'nullable|string|max:1000',

            'priority' => 'required|in:baja,media,alta',

            'due_date' => 'nullable|date',

            'project_id' => [
                'nullable',
                Rule::exists('projects', 'id')
                    ->where(function ($query) {
                        $query->where(
                            'user_id',
                            auth()->id()
                        );
                    }),
            ],
        ]);

        $this->taskService->update(
            $task,
            $data
        );

        return redirect()
            ->route('tasks.index')
            ->with(
                'success',
                'Tarea actualizada correctamente.'
            );
    }

    public function destroy(Task $task)
    {
        $this->taskService->delete($task);

        return redirect()
            ->route('tasks.index')
            ->with(
                'success',
                'Tarea eliminada correctamente.'
            );
    }

    public function toggle(Task $task)
    {
        $this->taskService->toggle($task);

        return redirect()
            ->route('tasks.index');
    }
}