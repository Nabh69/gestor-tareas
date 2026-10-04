@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<style>

    .welcome {
        margin-bottom: 26px;
    }

    .welcome-date {
        color: #667085;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .welcome h1 {
        margin: 0 0 5px;
        font-size: 30px;
    }

    .welcome p {
        margin: 0;
        color: #667085;
        font-size: 14px;
    }


    .stats {
        display: grid;
        grid-template-columns:
            repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;

        border: 1px solid #e1e4e8;
        border-radius: 13px;

        padding: 18px;
    }

    .stat-number {
        font-size: 28px;
        font-weight: bold;

        margin-bottom: 5px;
    }

    .stat-label {
        color: #667085;
        font-size: 12px;
    }


    .quick-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;

        margin-bottom: 25px;
    }

    .quick-button {
        padding: 9px 14px;

        border-radius: 8px;

        text-decoration: none;

        font-size: 13px;

        background: white;

        border: 1px solid #dfe3e8;

        color: #1f2937;
    }

    .quick-button:hover {
        border-color: #5361e5;
        color: #5361e5;
    }

    .quick-primary {
        background: #5361e5;
        color: white;
        border-color: #5361e5;
    }

    .quick-primary:hover {
        color: white;
        background: #4450c7;
    }


    .dashboard-grid {
        display: grid;

        grid-template-columns:
            1.15fr 1fr;

        gap: 18px;

        margin-bottom: 18px;
    }


    .dashboard-card {
        background: white;

        border: 1px solid #e1e4e8;
        border-radius: 14px;

        padding: 20px;
    }


    .dashboard-card-header {
        display: flex;

        justify-content: space-between;
        align-items: center;

        gap: 15px;

        margin-bottom: 15px;
    }

    .dashboard-card-header h2 {
        margin: 0;
        font-size: 17px;
    }

    .dashboard-link {
        color: #5361e5;

        text-decoration: none;

        font-size: 12px;
    }


    .mini-task {
        padding: 12px 0;

        border-bottom:
            1px solid #eceef3;
    }

    .mini-task:last-child {
        border-bottom: none;
    }

    .mini-task-title {
        font-size: 14px;
        font-weight: bold;
    }

    .mini-task-meta {
        margin-top: 5px;

        color: #667085;

        font-size: 11px;
    }

    .task-project {
        color: #6653c7;
    }


    .mini-project {
        display: flex;

        align-items: center;

        gap: 12px;

        padding: 11px 0;

        border-bottom:
            1px solid #eceef3;

        text-decoration: none;

        color: #1f2937;
    }

    .mini-project:last-child {
        border-bottom: none;
    }

    .mini-project-icon {
        width: 38px;
        height: 38px;

        flex-shrink: 0;

        border-radius: 9px;

        background: #ecd5f1;

        display: flex;

        align-items: center;
        justify-content: center;
    }

    .mini-project-name {
        font-size: 14px;
        font-weight: bold;
    }

    .mini-project-count {
        color: #667085;

        font-size: 11px;

        margin-top: 3px;
    }


    .portfolio-list {
        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 12px;
    }

    .portfolio-item {
        display: block;

        background: #fafafa;

        border: 1px solid #e1e4e8;

        border-radius: 11px;

        padding: 15px;

        text-decoration: none;

        color: #1f2937;
    }

    .portfolio-item:hover {
        border-color: #b8bef2;
    }

    .portfolio-icon {
        width: 35px;
        height: 35px;

        border-radius: 8px;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #e8eafd;

        margin-bottom: 11px;
    }

    .portfolio-name {
        font-weight: bold;
        font-size: 14px;
    }

    .portfolio-count {
        color: #667085;

        font-size: 11px;

        margin-top: 5px;
    }


    .empty {
        color: #667085;

        font-size: 13px;

        padding: 18px 0;
    }


    @media(max-width: 1000px) {

        .stats {
            grid-template-columns:
                repeat(2, 1fr);
        }

        .portfolio-list {
            grid-template-columns: 1fr;
        }

    }


    @media(max-width: 750px) {

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .stats {
            grid-template-columns: 1fr;
        }

    }

</style>


<div class="welcome">

    <div class="welcome-date">

        {{ now()->locale('es')->translatedFormat(
            'l, d \d\e F'
        ) }}

    </div>

    <h1>
        Hola, {{ auth()->user()->name }}
    </h1>

    <p>
        Aquí tienes un resumen de tu trabajo.
    </p>

</div>


<div class="stats">

    <div class="stat-card">

        <div class="stat-number">
            {{ $pendingTasks }}
        </div>

        <div class="stat-label">
            Tareas pendientes
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-number">
            {{ $completedTasks }}
        </div>

        <div class="stat-label">
            Tareas completadas
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-number">
            {{ $totalProjects }}
        </div>

        <div class="stat-label">
            Proyectos
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-number">
            {{ $totalPortfolios }}
        </div>

        <div class="stat-label">
            Portafolios
        </div>

    </div>

</div>


<div class="quick-actions">

    <a
        class="quick-button quick-primary"
        href="{{ route('tasks.index') }}#new-task"
    >
        + Nueva tarea
    </a>

    <a
        class="quick-button"
        href="{{ route('projects.index') }}"
    >
        + Nuevo proyecto
    </a>

    <a
        class="quick-button"
        href="{{ route('portfolios.index') }}"
    >
        + Nuevo portafolio
    </a>

</div>


<div class="dashboard-grid">


    <div class="dashboard-card">

        <div class="dashboard-card-header">

            <h2>
                Tareas pendientes
            </h2>

            <a
                class="dashboard-link"
                href="{{ route('tasks.index') }}"
            >
                Ver todas
            </a>

        </div>


        @forelse($recentTasks as $task)

            <div class="mini-task">

                <div class="mini-task-title">
                    {{ $task->title }}
                </div>


                <div class="mini-task-meta">

                    Prioridad:
                    {{ ucfirst($task->priority) }}


                    @if($task->project)

                        ·

                        <span class="task-project">

                            {{ $task->project->name }}

                        </span>

                    @endif


                    @if($task->due_date)

                        · Vence:

                        {{ $task->due_date->format('d/m/Y') }}

                    @endif

                </div>

            </div>

        @empty

            <div class="empty">

                No tienes tareas pendientes.

            </div>

        @endforelse

    </div>



    <div class="dashboard-card">

        <div class="dashboard-card-header">

            <h2>
                Proyectos
            </h2>

            <a
                class="dashboard-link"
                href="{{ route('projects.index') }}"
            >
                Ver todos
            </a>

        </div>


        @forelse($projects as $project)

            <a
                class="mini-project"
                href="{{ route(
                    'projects.show',
                    $project
                ) }}"
            >

                <div class="mini-project-icon">
                    ▦
                </div>


                <div>

                    <div class="mini-project-name">

                        {{ $project->name }}

                    </div>

                    <div class="mini-project-count">

                        {{ $project->tasks_count }}

                        {{
                            $project->tasks_count == 1
                                ? 'tarea'
                                : 'tareas'
                        }}

                    </div>

                </div>

            </a>

        @empty

            <div class="empty">

                Todavía no tienes proyectos.

            </div>

        @endforelse

    </div>

</div>



<div class="dashboard-card">

    <div class="dashboard-card-header">

        <h2>
            Portafolios
        </h2>

        <a
            class="dashboard-link"
            href="{{ route('portfolios.index') }}"
        >
            Ver todos
        </a>

    </div>


    @if($portfolios->count() > 0)

        <div class="portfolio-list">

            @foreach($portfolios as $portfolio)

                <a
                    class="portfolio-item"
                    href="{{ route(
                        'portfolios.show',
                        $portfolio
                    ) }}"
                >

                    <div class="portfolio-icon">
                        □
                    </div>

                    <div class="portfolio-name">

                        {{ $portfolio->name }}

                    </div>

                    <div class="portfolio-count">

                        {{ $portfolio->projects_count }}

                        {{
                            $portfolio->projects_count == 1
                                ? 'proyecto'
                                : 'proyectos'
                        }}

                    </div>

                </a>

            @endforeach

        </div>

    @else

        <div class="empty">

            Todavía no tienes portafolios.

        </div>

    @endif

</div>

@endsection