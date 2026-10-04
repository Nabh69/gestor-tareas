<?php

namespace App\Services;

use App\Models\Portfolio;

class PortfolioService
{
    public function getAll()
    {
        return Portfolio::where('user_id', auth()->id())
            ->withCount('projects')
            ->latest()
            ->get();
    }

    public function create(array $data)
    {
        $data['user_id'] = auth()->id();

        return Portfolio::create($data);
    }

    public function updateProjects(
        Portfolio $portfolio,
        array $projectIds
    ) {
        $this->validateOwner($portfolio);

        $portfolio->projects()->sync($projectIds);

        return $portfolio;
    }

    public function delete(Portfolio $portfolio)
    {
        $this->validateOwner($portfolio);

        return $portfolio->delete();
    }

    public function validateOwner(Portfolio $portfolio)
    {
        abort_unless(
            $portfolio->user_id === auth()->id(),
            403
        );
    }
}