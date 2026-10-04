<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Portfolio;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalTasks = Task::where('user_id', $userId)
            ->count();

        $pendingTasks = Task::where('user_id', $userId)
            ->where('done', false)
            ->count();

        $completedTasks = Task::where('user_id', $userId)
            ->where('done', true)
            ->count();

        $totalProjects = Project::where('user_id', $userId)
            ->count();

        $totalPortfolios = Portfolio::where('user_id', $userId)
            ->count();

        $recentTasks = Task::where('user_id', $userId)
            ->where('done', false)
            ->with('project')
            ->orderByRaw("
                CASE
                    WHEN due_date IS NULL THEN 1
                    ELSE 0
                END
            ")
            ->orderBy('due_date')
            ->take(5)
            ->get();

        $projects = Project::where('user_id', $userId)
            ->withCount('tasks')
            ->latest()
            ->take(4)
            ->get();

        $portfolios = Portfolio::where('user_id', $userId)
            ->withCount('projects')
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard.index', compact(
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'totalProjects',
            'totalPortfolios',
            'recentTasks',
            'projects',
            'portfolios'
        ));
    }
}