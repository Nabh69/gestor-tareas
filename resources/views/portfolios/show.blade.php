@extends('layouts.app')

@section('title', $portfolio->name)

@section('content')

<style>

    .portfolio-back {
        display: inline-block;
        margin-bottom: 16px;

        color: #667085;
        text-decoration: none;

        font-size: 13px;
    }

    .portfolio-back:hover {
        color: #5361e5;
    }

    .portfolio-header {
        margin-bottom: 25px;
    }

    .portfolio-header h1 {
        margin: 0 0 7px;
    }

    .portfolio-header p {
        margin: 0;

        color: #667085;
    }

    .portfolio-summary {
        display: flex;

        gap: 12px;

        margin: 22px 0;

        flex-wrap: wrap;
    }

    .summary-card {
        background: white;

        border: 1px solid #e1e4e8;

        border-radius: 12px;

        padding: 15px 18px;

        min-width: 150px;
    }

    .summary-number {
        font-size: 25px;

        font-weight: bold;
    }

    .summary-label {
        margin-top: 4px;

        color: #667085;

        font-size: 12px;
    }

    .portfolio-card {
        background: white;

        border: 1px solid #e1e4e8;

        border-radius: 14px;

        padding: 20px;
    }

    .portfolio-card h2 {
        margin-top: 0;

        font-size: 18px;
    }

    .portfolio-card-description {
        margin-bottom: 20px;

        color: #667085;

        font-size: 13px;
    }

    .projects-list {
        display: grid;

        grid-template-columns:
            repeat(
                auto-fill,
                minmax(240px, 1fr)
            );

        gap: 12px;
    }

    .project-option {
        position: relative;
    }

    .project-option input {
        position: absolute;

        opacity: 0;

        pointer-events: none;
    }

    .project-option label {
        display: block;

        height: 100%;

        background: #fafafa;

        border: 2px solid #e1e4e8;

        border-radius: 11px;

        padding: 15px;

        cursor: pointer;

        transition: .15s;
    }

    .project-option label:hover {
        border-color: #b8bef2;

        background: #f8f8ff;
    }

    .project-option input:checked + label {
        border-color: #5361e5;

        background: #f0f1ff;
    }

    .project-top {
        display: flex;

        align-items: center;

        gap: 10px;

        margin-bottom: 9px;
    }

    .project-icon {
        width: 34px;
        height: 34px;

        flex-shrink: 0;

        border-radius: 8px;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #ecd5f1;
    }

    .project-name {
        font-weight: bold;

        font-size: 14px;
    }

    .project-description {
        min-height: 35px;

        color: #667085;

        font-size: 12px;

        line-height: 1.4;
    }

    .project-count {
        margin-top: 10px;

        font-size: 11px;

        color: #667085;
    }

    .selected-mark {
        margin-left: auto;

        color: #5361e5;

        font-size: 18px;

        visibility: hidden;
    }

    .project-option
    input:checked
    + label
    .selected-mark {
        visibility: visible;
    }

    .save-area {
        display: flex;

        justify-content: flex-end;

        margin-top: 20px;

        padding-top: 18px;

        border-top: 1px solid #eceef3;
    }

    .btn-save {
        border: none;

        border-radius: 8px;

        padding: 10px 18px;

        background: #5361e5;

        color: white;

        font-weight: bold;

        cursor: pointer;
    }

    .empty-projects {
        padding: 35px 20px;

        text-align: center;

        color: #667085;

        grid-column: 1 / -1;

        border: 1px dashed #dfe3e8;

        border-radius: 10px;
    }

</style>


<a
    class="portfolio-back"
    href="{{ route('portfolios.index') }}"
>
    ← Volver a portafolios
</a>


<div class="portfolio-header">

    <h1>
        {{ $portfolio->name }}
    </h1>

    <p>
        {{
            $portfolio->description
                ?: 'Sin descripción.'
        }}
    </p>

</div>


@if(session('success'))

    <div class="alert alert-success">

        {{ session('success') }}

    </div>

@endif


@if($errors->any())

    <div class="alert alert-error">

        {{ $errors->first() }}

    </div>

@endif


<div class="portfolio-summary">

    <div class="summary-card">

        <div class="summary-number">

            {{ $portfolio->projects->count() }}

        </div>

        <div class="summary-label">

            Proyectos incluidos

        </div>

    </div>


    <div class="summary-card">

        <div class="summary-number">

            {{
                $portfolio->projects
                    ->sum(function ($project) {
                        return $project->tasks()->count();
                    })
            }}

        </div>

        <div class="summary-label">

            Tareas en total

        </div>

    </div>

</div>


<div class="portfolio-card">


    <h2>
        Proyectos del portafolio
    </h2>


    <div class="portfolio-card-description">

        Selecciona los proyectos que quieres
        incluir en este portafolio.

    </div>


    <form
        method="POST"
        action="{{ route(
            'portfolios.projects.update',
            $portfolio
        ) }}"
    >

        @csrf
        @method('PATCH')


        <div class="projects-list">


            @forelse($projects as $project)


                @php

                    $selected =
                        $portfolio
                            ->projects
                            ->contains(
                                'id',
                                $project->id
                            );

                @endphp


                <div class="project-option">


                    <input
                        type="checkbox"
                        name="projects[]"
                        value="{{ $project->id }}"
                        id="project-{{ $project->id }}"
                        {{ $selected ? 'checked' : '' }}
                    >


                    <label
                        for="project-{{ $project->id }}"
                    >


                        <div class="project-top">


                            <div class="project-icon">
                                ▦
                            </div>


                            <div class="project-name">

                                {{ $project->name }}

                            </div>


                            <div class="selected-mark">
                                ✓
                            </div>


                        </div>


                        <div class="project-description">

                            {{
                                $project->description
                                    ?: 'Sin descripción.'
                            }}

                        </div>


                        <div class="project-count">

                            {{ $project->tasks_count }}

                            {{
                                $project->tasks_count == 1
                                    ? 'tarea'
                                    : 'tareas'
                            }}

                        </div>


                    </label>


                </div>


            @empty


                <div class="empty-projects">

                    Todavía no tienes proyectos.

                    <br><br>

                    <a
                        href="{{ route('projects.index') }}"
                        class="btn btn-primary"
                    >
                        Crear proyecto
                    </a>

                </div>


            @endforelse


        </div>


        @if($projects->count() > 0)

            <div class="save-area">

                <button
                    type="submit"
                    class="btn-save"
                >
                    Guardar proyectos
                </button>

            </div>

        @endif


    </form>


</div>

@endsection