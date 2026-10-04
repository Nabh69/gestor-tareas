@extends('layouts.app')

@section('title', 'Editar tarea')

@section('content')

<style>

    .edit-wrapper {
        max-width: 850px;
    }

    .edit-header {
        margin-bottom: 24px;
    }

    .edit-header h1 {
        margin: 0 0 6px;
    }

    .edit-header p {
        margin: 0;
        color: #667085;
    }

    .edit-card {
        background: white;
        border: 1px solid #e1e4e8;
        border-radius: 14px;
        padding: 22px;
    }

    .edit-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 12px;
    }

    .edit-grid textarea {
        grid-column: 1 / -1;
        min-height: 110px;
        resize: vertical;
    }

    .edit-grid input,
    .edit-grid select,
    .edit-grid textarea {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #dfe3e8;
        border-radius: 9px;
        font-size: 14px;
    }

    .edit-actions {
        display: flex;
        gap: 10px;
        margin-top: 18px;
    }

    .btn-save {
        background: #5361e5;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-cancel {
        background: #eceef3;
        color: #1f2937;
        border-radius: 8px;
        padding: 10px 16px;
        text-decoration: none;
    }

    @media(max-width: 750px) {
        .edit-grid {
            grid-template-columns: 1fr;
        }

        .edit-grid textarea {
            grid-column: auto;
        }
    }

</style>


<div class="edit-wrapper">

    <div class="edit-header">

        <h1>Editar tarea</h1>

        <p>
            Modifica la información de la tarea seleccionada.
        </p>

    </div>


    @if ($errors->any())

        <div class="alert alert-error">

            {{ $errors->first() }}

        </div>

    @endif


    <div class="edit-card">

        <form
            method="POST"
            action="{{ route('tasks.update', $task) }}"
        >

            @csrf
            @method('PUT')


            <div class="edit-grid">

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $task->title) }}"
                    placeholder="Título de la tarea"
                    required
                >


                <select name="project_id">

                    <option value="">
                        Sin proyecto
                    </option>

                    @foreach($projects as $project)

                        <option
                            value="{{ $project->id }}"
                            {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}
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
                        {{ old('priority', $task->priority) === 'baja' ? 'selected' : '' }}
                    >
                        Prioridad baja
                    </option>

                    <option
                        value="media"
                        {{ old('priority', $task->priority) === 'media' ? 'selected' : '' }}
                    >
                        Prioridad media
                    </option>

                    <option
                        value="alta"
                        {{ old('priority', $task->priority) === 'alta' ? 'selected' : '' }}
                    >
                        Prioridad alta
                    </option>

                </select>


                <input
                    type="date"
                    name="due_date"
                    value="{{ old(
                        'due_date',
                        $task->due_date
                            ? $task->due_date->format('Y-m-d')
                            : ''
                    ) }}"
                >


                <textarea
                    name="description"
                    placeholder="Descripción opcional"
                >{{ old('description', $task->description) }}</textarea>

            </div>


            <div class="edit-actions">

                <button
                    class="btn-save"
                    type="submit"
                >
                    Guardar cambios
                </button>


                <a
                    class="btn-cancel"
                    href="{{ route('tasks.index') }}"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

@endsection