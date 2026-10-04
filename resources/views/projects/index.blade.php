@extends('layouts.app')

@section('title', 'Proyectos')

@section('content')

<style>
    .projects-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .projects-header h1 {
        margin: 0;
    }

    .projects-header p {
        margin: 6px 0 0;
        color: #667085;
    }

    .project-form {
        background: white;
        border: 1px solid #dfe3e8;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .project-form h3 {
        margin-top: 0;
        margin-bottom: 15px;
    }

    .project-form-grid {
        display: grid;
        grid-template-columns: 1fr 2fr auto;
        gap: 10px;
    }

    .project-form input {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #dfe3e8;
        border-radius: 9px;
        font-size: 14px;
    }

    .project-form button {
        background: #3d4fe0;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        cursor: pointer;
        font-weight: bold;
    }

    .projects-grid {
        display: grid;
        grid-template-columns:
            repeat(auto-fill, minmax(250px, 1fr));

        gap: 18px;
    }

    .project-card {
        background: white;
        border: 1px solid #dfe3e8;
        border-radius: 14px;
        padding: 20px;
        transition: .2s;
    }

    .project-card:hover {
        transform: translateY(-2px);

        box-shadow:
            0 8px 20px rgba(0,0,0,.07);
    }

    .project-icon {
        width: 42px;
        height: 42px;

        display: flex;
        justify-content: center;
        align-items: center;

        background: #e9ebfc;
        color: #3d4fe0;

        border-radius: 10px;

        font-size: 20px;

        margin-bottom: 15px;
    }

    .project-card h3 {
        margin: 0 0 7px;
    }

    .project-description {
        color: #667085;
        font-size: 13px;
        min-height: 38px;
        line-height: 1.4;
    }

    .project-info {
        margin-top: 15px;
        padding-top: 13px;

        border-top: 1px solid #eceef3;

        display: flex;
        justify-content: space-between;
        align-items: center;

        font-size: 12px;
        color: #667085;
    }

    .btn-delete-project {
        border: none;
        background: transparent;
        color: #c1443a;

        cursor: pointer;
        font-size: 12px;
    }

    .empty-projects {
        grid-column: 1 / -1;

        background: white;

        border: 1px dashed #dfe3e8;
        border-radius: 14px;

        padding: 50px 20px;

        text-align: center;

        color: #667085;
    }

    @media(max-width: 700px) {

        .project-form-grid {
            grid-template-columns: 1fr;
        }

    }
</style>


<div class="projects-header">

    <div>

        <h1>Proyectos</h1>

        <p>
            Organiza tus tareas por cursos,
            trabajos o proyectos personales.
        </p>

    </div>

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


<div class="project-form">

    <h3>Crear nuevo proyecto</h3>

    <form
        method="POST"
        action="{{ route('projects.store') }}"
    >

        @csrf

        <div class="project-form-grid">

            <input
                type="text"
                name="name"
                placeholder="Nombre del proyecto"
                value="{{ old('name') }}"
                required
            >

            <input
                type="text"
                name="description"
                placeholder="Descripción del proyecto"
                value="{{ old('description') }}"
            >

            <button type="submit">
                + Crear proyecto
            </button>

        </div>

    </form>

</div>


<div class="projects-grid">

    @forelse ($projects as $project)

        <div class="project-card">

            <div class="project-icon">
                ▦
            </div>

            <h3>
    <a
        href="{{ route('projects.show', $project) }}"
        style="
            color: #1f2937;
            text-decoration: none;
        "
    >
        {{ $project->name }}
    </a>
</h3>

            <div class="project-description">

                @if ($project->description)

                    {{ $project->description }}

                @else

                    Sin descripción.

                @endif

            </div>

            <div class="project-info">

                <span>
                    {{ $project->tasks->count() }}
                    tarea(s)
                </span>

                <form
                    method="POST"
                    action="{{ route(
                        'projects.destroy',
                        $project
                    ) }}"
                    onsubmit="
                        return confirm(
                            '¿Eliminar este proyecto?'
                        )
                    "
                >

                    @csrf
                    @method('DELETE')

                    <button
                        class="btn-delete-project"
                        type="submit"
                    >
                        Eliminar
                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="empty-projects">

            <h3>
                Todavía no tienes proyectos
            </h3>

            <p>
                Crea tu primer proyecto para
                empezar a organizar tus tareas.
            </p>

        </div>

    @endforelse

</div>

@endsection