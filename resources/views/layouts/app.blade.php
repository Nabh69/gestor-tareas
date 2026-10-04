<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Listado')
    </title>

    <style>

        :root {
            --bg: #f6f7f9;
            --sidebar: #202124;
            --sidebar-hover: #303134;
            --sidebar-active: #3c4043;

            --surface: #ffffff;

            --ink: #1f2937;
            --soft: #667085;

            --border: #e1e4e8;

            --accent: #5361e5;

            --danger: #c1443a;
            --good: #2f8f5b;
            --warn: #c97a1a;
        }


        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;

            font-family:
                Arial,
                sans-serif;

            background: var(--bg);

            color: var(--ink);
        }


        .app-shell {
            display: flex;

            min-height: 100vh;
        }



        /*
        |--------------------------------------------------------------------------
        | SIDEBAR
        |--------------------------------------------------------------------------
        */


        .sidebar {
            width: 245px;

            background: var(--sidebar);

            color: white;

            padding: 18px 12px;

            display: flex;

            flex-direction: column;

            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            overflow-y: auto;

            z-index: 20;
        }


        .brand {
            display: flex;

            align-items: center;

            gap: 10px;

            padding: 8px 10px;

            margin-bottom: 15px;

            font-size: 19px;

            font-weight: bold;
        }


        .brand-icon {
            width: 11px;

            height: 11px;

            border-radius: 3px;

            background: #ff6b5c;

            transform: rotate(45deg);
        }


        /*
        |--------------------------------------------------------------------------
        | BOTÓN CREAR
        |--------------------------------------------------------------------------
        */


        .create-button {
            display: block;

            padding: 10px 13px;

            margin-bottom: 18px;

            background: #ffffff;

            color: #202124;

            border-radius: 8px;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;

            transition: .2s;
        }


        .create-button:hover {
            background: #ececec;
        }



        /*
        |--------------------------------------------------------------------------
        | NAVEGACIÓN
        |--------------------------------------------------------------------------
        */


        .sidebar-title {
            padding: 8px 10px 5px;

            color: #9ca3af;

            font-size: 11px;

            font-weight: bold;

            text-transform: uppercase;

            letter-spacing: .5px;
        }


        .nav-item {
            display: flex;

            align-items: center;

            gap: 11px;

            padding: 9px 11px;

            margin: 2px 0;

            border-radius: 7px;

            color: #dedede;

            text-decoration: none;

            font-size: 14px;

            transition: .15s;
        }


        .nav-item:hover {
            background: var(--sidebar-hover);

            color: white;
        }


        .nav-item.active {
            background: var(--sidebar-active);

            color: white;
        }


        .nav-icon {
            width: 19px;

            text-align: center;

            font-size: 15px;
        }



        /*
        |--------------------------------------------------------------------------
        | PROYECTOS DEL SIDEBAR
        |--------------------------------------------------------------------------
        */


        .sidebar-projects {
            margin-top: 15px;

            margin-bottom: 15px;
        }


        .sidebar-project {
            display: flex;

            align-items: center;

            gap: 9px;

            padding: 8px 11px;

            margin: 2px 0;

            border-radius: 7px;

            color: #d5d5d5;

            font-size: 13px;

            text-decoration: none;

            transition: .15s;

            overflow: hidden;
        }


        .sidebar-project:hover {
            background: var(--sidebar-hover);

            color: white;
        }


        .sidebar-project.active {
            background: var(--sidebar-active);

            color: white;
        }


        .project-dot {
            width: 10px;

            height: 10px;

            flex-shrink: 0;

            border-radius: 3px;

            background: #d889e5;
        }


        .sidebar-project-name {
            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        .no-projects {
            padding: 8px 11px;

            font-size: 12px;

            color: #8c9198;
        }



        /*
        |--------------------------------------------------------------------------
        | USUARIO
        |--------------------------------------------------------------------------
        */


        .sidebar-user {
            margin-top: auto;

            border-top:
                1px solid #3a3b3d;

            padding-top: 14px;
        }


        .user-box {
            display: flex;

            align-items: center;

            gap: 10px;

            padding: 8px;
        }


        .avatar {
            width: 34px;

            height: 34px;

            flex-shrink: 0;

            border-radius: 50%;

            background: #86d6bd;

            color: #15372e;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: bold;
        }


        .user-data {
            min-width: 0;
        }


        .user-name {
            font-size: 13px;

            font-weight: bold;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        .user-email {
            max-width: 145px;

            margin-top: 2px;

            color: #a8adb5;

            font-size: 10px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        .logout-button {
            width: 100%;

            background: transparent;

            border: none;

            color: #c7c7c7;

            padding: 9px 11px;

            text-align: left;

            cursor: pointer;

            border-radius: 7px;

            font-size: 13px;
        }


        .logout-button:hover {
            background: #3a3b3d;

            color: white;
        }



        /*
        |--------------------------------------------------------------------------
        | CONTENIDO PRINCIPAL
        |--------------------------------------------------------------------------
        */


        .main {
            margin-left: 245px;

            width:
                calc(100% - 245px);

            min-height: 100vh;
        }


        .topbar {
            height: 58px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 32px;

            background: white;

            border-bottom:
                1px solid var(--border);

            position: sticky;

            top: 0;

            z-index: 10;
        }


        .topbar-title {
            font-size: 14px;

            font-weight: bold;
        }


        .topbar-user {
            color: var(--soft);

            font-size: 13px;
        }


        .content {
            max-width: 1200px;

            padding: 32px;

            margin: 0 auto;
        }



        /*
        |--------------------------------------------------------------------------
        | COMPONENTES GENERALES
        |--------------------------------------------------------------------------
        */


        h1 {
            margin-top: 0;
        }


        .subtitle {
            color: var(--soft);
        }


        .card {
            background: var(--surface);

            border:
                1px solid var(--border);

            border-radius: 14px;

            padding: 18px;

            margin-bottom: 18px;
        }


        .alert {
            padding: 11px 13px;

            border-radius: 9px;

            margin-bottom: 16px;
        }


        .alert-success {
            background: #e4f5eb;

            color: #1f6d45;
        }


        .alert-error {
            background: #fbe9e7;

            color: var(--danger);
        }



        /*
        |--------------------------------------------------------------------------
        | FORMULARIOS
        |--------------------------------------------------------------------------
        */


        .form-grid {
            display: grid;

            grid-template-columns:
                2fr 1fr 1fr;

            gap: 10px;
        }


        .form-grid textarea {
            grid-column:
                1 / -1;

            min-height: 90px;

            resize: vertical;
        }


        input,
        select,
        textarea {
            width: 100%;

            padding: 10px 12px;

            border:
                1px solid var(--border);

            border-radius: 9px;

            font: inherit;

            background: white;
        }


        input:focus,
        select:focus,
        textarea:focus {
            outline:
                2px solid var(--accent);

            outline-offset: 1px;

            border-color: transparent;
        }


        button,
        .btn {
            border: none;

            border-radius: 8px;

            padding: 9px 14px;

            cursor: pointer;

            text-decoration: none;

            display: inline-block;

            font: inherit;
        }


        .btn-primary {
            background: var(--accent);

            color: white;
        }


        .btn-secondary {
            background: #eceef3;

            color: var(--ink);
        }


        .btn-danger {
            background: #fbe9e7;

            color: var(--danger);
        }



        /*
        |--------------------------------------------------------------------------
        | TAREAS
        |--------------------------------------------------------------------------
        */


        .task {
            display: flex;

            gap: 12px;

            align-items: flex-start;

            justify-content: space-between;

            background: white;

            border:
                1px solid var(--border);

            border-radius: 10px;

            padding: 14px;

            margin-bottom: 9px;
        }


        .task.done {
            opacity: .6;
        }


        .task.done .task-title {
            text-decoration:
                line-through;
        }


        .task-main {
            flex: 1;
        }


        .task-title {
            font-weight: bold;

            margin-bottom: 5px;
        }


        .task-description {
            color: #4b5563;

            margin-bottom: 7px;

            font-size: 13px;
        }


        .meta {
            font-size: 12px;

            color: var(--soft);
        }


        .badge {
            display: inline-block;

            padding: 3px 8px;

            border-radius: 999px;

            font-size: 11px;

            font-weight: bold;

            margin-right: 6px;
        }


        .alta {
            background: #fbe9e7;

            color: var(--danger);
        }


        .media {
            background: #fcefdd;

            color: var(--warn);
        }


        .baja {
            background: #e4f5eb;

            color: var(--good);
        }


        .actions {
            display: flex;

            gap: 5px;

            flex-wrap: wrap;
        }



        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */


        @media(max-width: 900px) {

            .sidebar {
                width: 210px;
            }


            .main {
                margin-left: 210px;

                width:
                    calc(100% - 210px);
            }


            .content {
                padding: 22px;
            }


            .topbar {
                padding: 0 22px;
            }


            .form-grid {
                grid-template-columns:
                    1fr;
            }


            .form-grid textarea {
                grid-column: auto;
            }

        }


        @media(max-width: 650px) {

            .sidebar {
                position: static;

                width: 100%;

                min-height: auto;
            }


            .app-shell {
                display: block;
            }


            .main {
                margin-left: 0;

                width: 100%;
            }


            .sidebar-user {
                margin-top: 15px;
            }


            .topbar {
                position: static;
            }


            .content {
                padding: 18px;
            }

        }

    </style>

</head>


<body>


<div class="app-shell">


    <!-- =========================================================
         SIDEBAR
    ========================================================== -->

    <aside class="sidebar">


        <!-- LOGO -->

        <div class="brand">

            <span class="brand-icon"></span>

            LISTADO

        </div>



        <!-- CREAR TAREA -->

        <a
            class="create-button"
            href="{{ route('tasks.index') }}#new-task"
        >
            + Crear tarea
        </a>



        <!-- NAVEGACIÓN PRINCIPAL -->

        <div class="sidebar-title">
            Trabajo
        </div>


        <a
            class="
                nav-item
                {{ request()->routeIs('dashboard')
                    ? 'active'
                    : ''
                }}
            "
            href="{{ route('dashboard') }}"
        >

            <span class="nav-icon">
                ◇
            </span>

            Inicio

        </a>


        <a
            class="
                nav-item
                {{ request()->routeIs('tasks.*')
                    ? 'active'
                    : ''
                }}
            "
            href="{{ route('tasks.index') }}"
        >

            <span class="nav-icon">
                ✓
            </span>

            Mis tareas

        </a>


        <a
            class="
                nav-item
                {{ request()->routeIs('projects.*')
                    ? 'active'
                    : ''
                }}
            "
            href="{{ route('projects.index') }}"
        >

            <span class="nav-icon">
                ▦
            </span>

            Proyectos

        </a>



        <!--
            Portafolios todavía no está implementado.
            Más adelante cambiaremos # por route('portfolios.index')
        -->

<a
    class="
        nav-item
        {{ request()->routeIs('portfolios.*')
            ? 'active'
            : ''
        }}
    "
    href="{{ route('portfolios.index') }}"
>

    <span class="nav-icon">
        □
    </span>

    Portafolios

</a>



        <!-- =====================================================
             MIS PROYECTOS
        ====================================================== -->

        <div class="sidebar-projects">


            <div class="sidebar-title">
                Mis proyectos
            </div>


            @forelse($sidebarProjects as $project)


                <a
                    class="
                        sidebar-project

                        {{
                            request()->routeIs('projects.show')
                            &&
                            request()->route('project')
                            &&
                            request()->route('project')->id === $project->id
                                ? 'active'
                                : ''
                        }}
                    "
                    href="{{ route(
                        'projects.show',
                        $project
                    ) }}"
                >

                    <span class="project-dot"></span>


                    <span class="sidebar-project-name">

                        {{ $project->name }}

                    </span>


                </a>


            @empty


                <div class="no-projects">

                    Sin proyectos todavía

                </div>


            @endforelse


        </div>



        <!-- =====================================================
             USUARIO
        ====================================================== -->

        <div class="sidebar-user">


            <div class="user-box">


                <div class="avatar">

                    {{
                        strtoupper(
                            substr(
                                auth()->user()->name,
                                0,
                                1
                            )
                        )
                    }}

                </div>


                <div class="user-data">


                    <div class="user-name">

                        {{ auth()->user()->name }}

                    </div>


                    <div class="user-email">

                        {{ auth()->user()->email }}

                    </div>


                </div>


            </div>



            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf


                <button
                    type="submit"
                    class="logout-button"
                >
                    Cerrar sesión
                </button>


            </form>


        </div>


    </aside>



    <!-- =========================================================
         CONTENIDO PRINCIPAL
    ========================================================== -->

    <main class="main">


        <!-- TOPBAR -->

        <header class="topbar">


            <div class="topbar-title">

                Gestor de tareas académicas

            </div>


            <div class="topbar-user">

                {{ auth()->user()->name }}

            </div>


        </header>



        <!-- CONTENIDO DE CADA PÁGINA -->

        <div class="content">

            @yield('content')

        </div>


    </main>


</div>


</body>

</html>