@extends('layouts.app')

@section('title', 'Portafolios')

@section('content')

<style>

    .portfolio-header {
        margin-bottom: 25px;
    }

    .portfolio-header h1 {
        margin: 0 0 6px;
    }

    .portfolio-header p {
        margin: 0;
        color: #667085;
    }

    .portfolio-form-card {
        background: white;
        border: 1px solid #e1e4e8;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .portfolio-form-card h3 {
        margin-top: 0;
        margin-bottom: 16px;
    }

    .portfolio-form-grid {
        display: grid;
        grid-template-columns: 1fr 2fr auto;
        gap: 10px;
    }

    .portfolio-form-grid input {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #dfe3e8;
        border-radius: 9px;
        font-size: 14px;
    }

    .btn-create-portfolio {
        background: #5361e5;
        color: white;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        cursor: pointer;
        font-weight: bold;
    }

    .portfolio-grid {
        display: grid;

        grid-template-columns:
            repeat(auto-fill, minmax(270px, 1fr));

        gap: 18px;
    }

    .portfolio-card {
        background: white;
        border: 1px solid #e1e4e8;
        border-radius: 14px;
        padding: 20px;
        transition: .2s;
    }

    .portfolio-card:hover {
        transform: translateY(-2px);

        box-shadow:
            0 8px 22px rgba(0, 0, 0, .07);
    }

    .portfolio-icon {
        width: 44px;
        height: 44px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 11px;

        background: #e8eafd;
        color: #5361e5;

        font-size: 20px;

        margin-bottom: 15px;
    }

    .portfolio-name {
        margin: 0 0 8px;
        font-size: 17px;
    }

    .portfolio-name a {
        color: #1f2937;
        text-decoration: none;
    }

    .portfolio-name a:hover {
        color: #5361e5;
    }

    .portfolio-description {
        color: #667085;
        font-size: 13px;
        line-height: 1.5;
        min-height: 40px;
    }

    .portfolio-open {
        display: inline-block;

        margin-top: 15px;

        padding: 8px 12px;

        border-radius: 7px;

        background: #5361e5;
        color: white;

        text-decoration: none;

        font-size: 12px;
        font-weight: bold;
    }

    .portfolio-open:hover {
        background: #4450c7;
    }

    .portfolio-footer {
        display: flex;

        justify-content: space-between;
        align-items: center;

        gap: 10px;

        margin-top: 17px;

        padding-top: 14px;

        border-top: 1px solid #eceef3;
    }

    .project-count {
        color: #667085;
        font-size: 12px;
    }

    .btn-delete-portfolio {
        background: #fbe9e7;
        color: #c1443a;

        border: none;
        border-radius: 7px;

        padding: 7px 10px;

        font-size: 12px;

        cursor: pointer;
    }

    .empty-portfolios {
        grid-column: 1 / -1;

        background: white;

        border: 1px dashed #dfe3e8;
        border-radius: 14px;

        padding: 50px 20px;

        text-align: center;

        color: #667085;
    }

    @media(max-width: 700px) {

        .portfolio-form-grid {
            grid-template-columns: 1fr;
        }

    }

</style>


<div class="portfolio-header">

    <h1>
        Portafolios
    </h1>

    <p>
        Agrupa varios proyectos para organizar mejor
        tus trabajos y cursos.
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


<div class="portfolio-form-card">

    <h3>
        Crear nuevo portafolio
    </h3>


    <form
        method="POST"
        action="{{ route('portfolios.store') }}"
    >

        @csrf


        <div class="portfolio-form-grid">

            <input
                type="text"
                name="name"
                placeholder="Nombre del portafolio"
                value="{{ old('name') }}"
                required
            >


            <input
                type="text"
                name="description"
                placeholder="Descripción opcional"
                value="{{ old('description') }}"
            >


            <button
                type="submit"
                class="btn-create-portfolio"
            >
                + Crear portafolio
            </button>

        </div>

    </form>

</div>



<div class="portfolio-grid">


    @forelse($portfolios as $portfolio)


        <div class="portfolio-card">


            <div class="portfolio-icon">
                □
            </div>


            <h3 class="portfolio-name">

                <a
                    href="{{ route(
                        'portfolios.show',
                        $portfolio
                    ) }}"
                >
                    {{ $portfolio->name }}
                </a>

            </h3>


            <div class="portfolio-description">

                {{
                    $portfolio->description
                        ?: 'Sin descripción.'
                }}

            </div>


            <a
                class="portfolio-open"
                href="{{ route(
                    'portfolios.show',
                    $portfolio
                ) }}"
            >
                Abrir portafolio
            </a>


            <div class="portfolio-footer">


                <span class="project-count">

                    {{ $portfolio->projects_count }}

                    {{
                        $portfolio->projects_count == 1
                            ? 'proyecto'
                            : 'proyectos'
                    }}

                </span>


                <form
                    method="POST"
                    action="{{ route(
                        'portfolios.destroy',
                        $portfolio
                    ) }}"
                    onsubmit="
                        return confirm(
                            '¿Eliminar este portafolio?'
                        )
                    "
                >

                    @csrf
                    @method('DELETE')


                    <button
                        type="submit"
                        class="btn-delete-portfolio"
                    >
                        Eliminar
                    </button>

                </form>


            </div>

        </div>


    @empty


        <div class="empty-portfolios">

            <h3>
                Todavía no tienes portafolios
            </h3>

            <p>
                Crea uno para agrupar tus proyectos.
            </p>

        </div>


    @endforelse


</div>

@endsection