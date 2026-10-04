@extends('layouts.app')

@section('title', 'Mis tareas')

@section('content')

<style>

    .tasks-header {
        margin-bottom: 24px;
    }

    .tasks-header h1 {
        margin: 0 0 6px;
    }

    .tasks-header p {
        margin: 0;
        color: #667085;
    }

    .task-form-card {
        background: white;
        border: 1px solid #e1e4e8;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .task-form-card h3 {
        margin-top: 0;
        margin-bottom: 16px;
    }

    .task-form-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 10px;
    }

    .task-form-grid textarea {
        grid-column: 1 / -1;
        min-height: 80px;
        resize: vertical;
    }

    .task-form-grid input,
    .task-form-grid select,
    .task-form-grid textarea {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #dfe3e8;
        border-radius: 9px;
        font-size: 14px;
    }

    .btn-create-task {
        margin-top: 12px;
        background: #5361e5;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        cursor: pointer;
        font-weight: bold;
    }

    .task-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .task-item {
        background: white;
        border: 1px solid #e1e4e8;
        border-radius: 11px;
        padding: 15px;

        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .task-item.completed {
        opacity: .6;
    }

    .task-item.completed .task-title {
        text-decoration: line-through;
    }

    .task-content {
        flex: 1;
    }

    .task-title {
        font-weight: bold;
        font-size: 15px;
        margin-bottom: 5px;
    }

    .task-description {
        font-size: 13px;
        color: #667085;
        margin-bottom: 8px;
    }

    .task-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        align-items: center;
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

    .project-badge {
        background: #eee9fc;
        color: #6653c7;
    }

    .date-text {
        color: #667085;
        font-size: 12px;
    }

    .task-actions {
        display: flex;
        gap: 6px;
        align-items: flex-start;
        flex-wrap: wrap;
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
        cursor: pointer;
        text-decoration: none;
    }

    .btn-complete {
        background: #e4f5eb;
        color: #2f8f5b;
    }

    .btn-edit {
        background: #eceef3;
        color: #1f2937;
    }

    .btn-delete {
        background: #fbe9e7;
        color: #c1443a;
    }

    .empty-tasks {
        background: white;
        border: 1px dashed #dfe3e8;
        border-radius: 14px;
        padding: 45px 20px;
        text-align: center;
        color: #667085;
    }

    @media(max-width: 900px) {

        .task-form-grid {
            grid-template-columns: 1fr 1fr;
        }

        .task-form-grid textarea {
            grid-column: 1 / -1;
        }

    }

    @media(max-width: 650px) {

        .task-form-grid {
            grid-template-columns: 1fr;
        }

        .task-form-grid textarea {
            grid-column: auto;
        }

        .task-item {
            flex-direction: column;
        }

    }

</style>


<div class="tasks-header">

    <h1>Mis tareas</h1>

    <p>
        Organiza tus actividades y asígnalas a tus proyectos.
    </p>

</div>


@if (session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


@if ($errors->any())

    <div class="alert alert-error">
        {{ $errors->first() }}
    </div>

@endif


<div
    class="task-form-card"
    id="new-task"
>

    <h3>Crear nueva tarea</h3>

    <form
        method="POST"
        action="{{ route('tasks.store') }}"
    >

        @csrf

        <div class="task-form-grid">

            <input
                type="text"
                name="title"
                placeholder="Título de la tarea"
                value="{{ old('title') }}"
                required
            >


            <select name="project_id">

                <option value="">
                    Sin proyecto
                </option>

                @foreach($projects as $project)

                    <option
                        value="{{ $project->id }}"
                        {{ old('project_id') == $project->id ? 'selected' : '' }}
                    >
                        {{ $project->name }}
                    </option>

                @endforeach

            </select>


            <select
                name="priority"
                required
            >

                <option
                    value="baja"
                    {{ old('priority') === 'baja' ? 'selected' : '' }}
                >
                    Prioridad baja
                </option>

                <option
                    value="media"
                    {{ old('priority', 'media') === 'media' ? 'selected' : '' }}
                >
                    Prioridad media
                </option>

                <option
                    value="alta"
                    {{ old('priority') === 'alta' ? 'selected' : '' }}
                >
                    Prioridad alta
                </option>

            </select>


            <input
                type="date"
                name="due_date"
                value="{{ old('due_date') }}"
            >


            <textarea
                name="description"
                placeholder="Descripción opcional"
            >{{ old('description') }}</textarea>

        </div>


        <button
            class="btn-create-task"
            type="submit"
        >
            + Crear tarea
        </button>

    </form>

</div>


<div class="task-list">

    @forelse($tasks as $task)

        <div
            class="task-item
            {{ $task->done ? 'completed' : '' }}"
        >

            <div class="task-content">

                <div class="task-title">
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


                    @if($task->project)

                        <span class="badge project-badge">
                            ▦ {{ $task->project->name }}
                        </span>

                    @else

                        <span class="badge project-badge">
                            Sin proyecto
                        </span>

                    @endif


                    @if($task->due_date)

                        <span class="date-text">

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
                        class="btn-complete"
                        type="submit"
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


                <form
                    method="POST"
                    action="{{ route(
                        'tasks.destroy',
                        $task
                    ) }}"
                    onsubmit="
                        return confirm(
                            '¿Eliminar esta tarea?'
                        )
                    "
                >

                    @csrf
                    @method('DELETE')

                    <button
                        class="btn-delete"
                        type="submit"
                    >
                        Eliminar
                    </button>

                </form>


            </div>

        </div>

    @empty

        <div class="empty-tasks">

            <h3>
                No tienes tareas todavía
            </h3>

            <p>
                Crea tu primera tarea y,
                si quieres, asígnala a un proyecto.
            </p>

        </div>

    @endforelse

</div>

@endsection