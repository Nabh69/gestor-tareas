<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear cuenta | Listado</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            font-family: Arial, sans-serif;

            background: #f3f4f7;
            color: #1b2430;
        }

        .container {
            width: 100%;
            max-width: 430px;
            padding: 20px;
        }

        .card {
            background: white;

            border: 1px solid #dfe3e8;
            border-radius: 16px;

            padding: 32px;

            box-shadow:
                0 10px 30px rgba(0,0,0,.08);
        }

        .brand {
            display: flex;
            align-items: center;

            gap: 10px;

            margin-bottom: 30px;
        }

        .brand-icon {
            width: 12px;
            height: 12px;

            background: #3d4fe0;

            border-radius: 3px;

            transform: rotate(45deg);
        }

        .brand-name {
            font-size: 20px;
            font-weight: bold;
        }

        h1 {
            margin: 0 0 8px;

            font-size: 27px;
        }

        .subtitle {
            margin: 0 0 25px;

            color: #667085;

            font-size: 14px;
        }

        .field {
            margin-bottom: 17px;
        }

        label {
            display: block;

            margin-bottom: 6px;

            font-size: 13px;
            font-weight: bold;
        }

        input {
            width: 100%;

            padding: 12px;

            border: 1px solid #dfe3e8;
            border-radius: 9px;

            font-size: 14px;
        }

        input:focus {
            outline: 2px solid #3d4fe0;
            border-color: transparent;
        }

        .btn-register {
            width: 100%;

            padding: 12px;

            background: #3d4fe0;
            color: white;

            border: none;
            border-radius: 9px;

            font-size: 15px;
            font-weight: bold;

            cursor: pointer;
        }

        .btn-register:hover {
            background: #3041c7;
        }

        .login {
            margin-top: 22px;

            text-align: center;

            color: #667085;

            font-size: 13px;
        }

        .login a {
            color: #3d4fe0;

            text-decoration: none;

            font-weight: bold;
        }

        .error {
            margin-bottom: 18px;

            padding: 10px 12px;

            background: #fbe9e7;
            color: #c1443a;

            border-radius: 9px;

            font-size: 13px;
        }

        .error ul {
            margin: 0;
            padding-left: 18px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <div class="brand">

            <div class="brand-icon"></div>

            <div class="brand-name">
                Listado
            </div>

        </div>

        <h1>Crea tu cuenta</h1>

        <p class="subtitle">
            Empieza a organizar tus tareas y proyectos académicos.
        </p>

        @if ($errors->any())

            <div class="error">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
            method="POST"
            action="{{ route('register.process') }}"
        >

            @csrf

            <div class="field">

                <label for="name">
                    Nombre completo
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Ejemplo: Laura Pérez"
                    required
                >

            </div>

            <div class="field">

                <label for="email">
                    Correo electrónico
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="correo@ejemplo.com"
                    required
                >

            </div>

            <div class="field">

                <label for="password">
                    Contraseña
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Mínimo 6 caracteres"
                    required
                >

            </div>

            <div class="field">

                <label for="password_confirmation">
                    Confirmar contraseña
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="Repite tu contraseña"
                    required
                >

            </div>

            <button
                class="btn-register"
                type="submit"
            >
                Crear cuenta
            </button>

        </form>

        <div class="login">

            ¿Ya tienes una cuenta?

            <a href="{{ route('login') }}">
                Iniciar sesión
            </a>

        </div>

    </div>

</div>

</body>
</html>