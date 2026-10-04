<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        $projects = $this->projectService->getAll();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->projectService->validateOwner($project);

        $project->load([
            'tasks' => function ($query) {
                $query
                    ->orderBy('done', 'asc')
                    ->orderBy('created_at', 'desc');
            }
        ]);

        return view('projects.show', compact('project'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'description' => 'nullable|string|max:500',
        ]);

        $this->projectService->create($data);

        return redirect()
            ->route('projects.index')
            ->with(
                'success',
                'Proyecto creado correctamente.'
            );
    }

    public function destroy(Project $project)
    {
        $this->projectService->delete($project);

        return redirect()
            ->route('projects.index')
            ->with(
                'success',
                'Proyecto eliminado correctamente.'
            );
    }
}