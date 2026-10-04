<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {

            $sidebarProjects = collect();

            if (Auth::check()) {

                $sidebarProjects = Project::where(
                    'user_id',
                    Auth::id()
                )
                ->latest()
                ->take(6)
                ->get();

            }

            $view->with(
                'sidebarProjects',
                $sidebarProjects
            );
        });
    }
}