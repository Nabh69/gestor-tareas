@extends('layouts.app')

@section('title', $project->name)

@section('content')

<style>

    .project-header {
        margin-bottom: 25px;
    }

    .project-back {
        display: inline-block;
        margin-bottom: 15px;

        color: #667085;
        text-decoration: none;
        font-size: 13px;
    }

    .project-back:hover {
        color: #5361e5;
    }

    .project-title-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
    }

    .project-title h1 {
        margin: 0 0 7px;
    }

    .project-title p {
        margin: 0;
        color: #667085;
    }

    .project-stats {
        display: flex;
        gap: 12px;
        margin: 25px 0;
        flex-wrap: wrap;
    }

    .stat {
        min-width: 145px;

        background: white;

        border: 1px solid #e1e4e8;
        border-radius: 12px;

        padding: 15px 17px;
    }

    .stat-number {
        font-size: 24px;
        font-weight: bold;
    }

    .stat-label {
        color: #667085;
        font-size: 12px;
        margin-top: 3px;
    }

    .section-title {
        margin-bottom: 15px;
        font-size: 18px;
    }

    .project-task {
        display: flex;
        justify-content: space-between;
        gap: 15px;

        padding: 14px 16px;

        background: white;

        border: 1px solid #e1e4e8;
        border-radius: 10px;

        margin-bottom: 9px;
    }

    .project-task.completed {
        opacity: .6;
    }

    .project-task.completed .task-name {
        text-decoration: line-through;
    }

    .task-information {
        flex: 1;
    }

    .task-name {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .task-description {
        color: #667085;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .task-meta {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
    }

    .badge {
        display: inline-block;

        padding: 3px 8px;

        border-radius: 999px;

        font-size: 11px;
        font-weight: bold;
    }

    .priority-alta {
        background: #fbe9e7;
        color: #c1443a;
    }

    .priority-media {
        background: #fcefdd;
        color: #c97a1a;
    }

    .priority-baja {
        background: #e4f5eb;
        color: #2f8f5b;
    }

    .date {
        color: #667085;
        font-size: 12px;
    }

    .task-actions {
        display: flex;
        gap: 6px;
        align-items: flex-start;
    }

    .task-actions form {
        margin: 0;
    }

    .task-actions button,
    .task-actions a {
        border: none;

        border-radius: 7px;

        padding: 7px 10px;

        font-size: 12px;

        text-decoration: none;
        cursor: pointer;
    }

    .btn-complete {
        background: #e4f5eb;
        color: #2f8f5b;
    }

    .btn-edit {
        background: #eceef3;
        color: #1f2937;
    }

    .empty-state {
        padding: 45px 20px;

        background: white;

        border: 1px dashed #dfe3e8;
        border-radius: 13px;

        text-align: center;
        color: #667085;
    }

</style>


<a
    class="project-back"
    href="{{ route('projects.index') }}"
>
    ← Volver a proyectos
</a>


<div class="project-header">

    <div class="project-title-row">

        <div class="project-title">

            <h1>
                {{ $project->name }}
            </h1>

            <p>
                {{ $project->description ?: 'Sin descripción.' }}
            </p>

        </div>

    </div>

</div>


@php

    $total = $project->tasks->count();

    $completed = $project->tasks
        ->where('done', true)
        ->count();

    $pending = $project->tasks
        ->where('done', false)
        ->count();

@endphp


<div class="project-stats">

    <div class="stat">

        <div class="stat-number">
            {{ $total }}
        </div>

        <div class="stat-label">
            Total de tareas
        </div>

    </div>


    <div class="stat">

        <div class="stat-number">
            {{ $pending }}
        </div>

        <div class="stat-label">
            Pendientes
        </div>

    </div>


    <div class="stat">

        <div class="stat-number">
            {{ $completed }}
        </div>

        <div class="stat-label">
            Completadas
        </div>

    </div>

</div>


<h2 class="section-title">
    Tareas del proyecto
</h2>


@forelse($project->tasks as $task)

    <div
        class="project-task
        {{ $task->done ? 'completed' : '' }}"
    >

        <div class="task-information">

            <div class="task-name">
                {{ $task->title }}
            </div>


            @if($task->description)

                <div class="task-description">
                    {{ $task->description }}
                </div>

            @endif


            <div class="task-meta">

                <span
                    class="badge
                    priority-{{ $task->priority }}"
                >
                    {{ ucfirst($task->priority) }}
                </span>


                @if($task->due_date)

                    <span class="date">

                        📅
                        {{ $task->due_date->format('d/m/Y') }}

                    </span>

                @endif

            </div>

        </div>


        <div class="task-actions">

            <form
                method="POST"
                action="{{ route(
                    'tasks.toggle',
                    $task
                ) }}"
            >

                @csrf
                @method('PATCH')

                <button
                    type="submit"
                    class="btn-complete"
                >

                    {{ $task->done
                        ? 'Reabrir'
                        : 'Completar'
                    }}

                </button>

            </form>


            <a
                class="btn-edit"
                href="{{ route(
                    'tasks.edit',
                    $task
                ) }}"
            >
                Editar
            </a>

        </div>

    </div>

@empty

    <div class="empty-state">

        <h3>
            Este proyecto todavía no tiene tareas
        </h3>

        <p>
            Ve a Mis tareas y crea una tarea
            asignándola a este proyecto.
        </p>

        <a
            class="btn btn-primary"
            href="{{ route('tasks.index') }}#new-task"
        >
            + Crear tarea
        </a>

    </div>

@endforelse

@endsection