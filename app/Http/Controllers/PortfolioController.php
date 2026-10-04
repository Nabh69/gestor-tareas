<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Project;
use App\Services\PortfolioService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PortfolioController extends Controller
{
    protected $portfolioService;

    public function __construct(
        PortfolioService $portfolioService
    ) {
        $this->portfolioService = $portfolioService;
    }

    public function index()
    {
        $portfolios = $this->portfolioService->getAll();

        return view(
            'portfolios.index',
            compact('portfolios')
        );
    }

    public function show(Portfolio $portfolio)
    {
        $this->portfolioService
            ->validateOwner($portfolio);

        $portfolio->load('projects');

        $projects = Project::where(
            'user_id',
            auth()->id()
        )
            ->withCount('tasks')
            ->orderBy('name')
            ->get();

        return view(
            'portfolios.show',
            compact(
                'portfolio',
                'projects'
            )
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'description' => 'nullable|string|max:500',
        ]);

        $this->portfolioService->create($data);

        return redirect()
            ->route('portfolios.index')
            ->with(
                'success',
                'Portafolio creado correctamente.'
            );
    }

    public function updateProjects(
        Request $request,
        Portfolio $portfolio
    ) {
        $this->portfolioService
            ->validateOwner($portfolio);

        $data = $request->validate([
            'projects' => 'nullable|array',

            'projects.*' => [
                'integer',

                Rule::exists('projects', 'id')
                    ->where(function ($query) {
                        $query->where(
                            'user_id',
                            auth()->id()
                        );
                    }),
            ],
        ]);

        $projectIds = $data['projects'] ?? [];

        $this->portfolioService->updateProjects(
            $portfolio,
            $projectIds
        );

        return redirect()
            ->route(
                'portfolios.show',
                $portfolio
            )
            ->with(
                'success',
                'Proyectos actualizados correctamente.'
            );
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->portfolioService
            ->delete($portfolio);

        return redirect()
            ->route('portfolios.index')
            ->with(
                'success',
                'Portafolio eliminado correctamente.'
            );
    }
}