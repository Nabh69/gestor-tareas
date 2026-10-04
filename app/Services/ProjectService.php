<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function getAll()
    {
        return Project::where('user_id', auth()->id())
            ->latest()
            ->get();
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->id();

        return Project::create($data);
    }

    public function delete(Project $project)
    {
        $this->validateOwner($project);

        return $project->delete();
    }

    public function validateOwner(Project $project)
    {
        abort_unless(
            $project->user_id === auth()->id(),
            403
        );
    }
}