<html xmlns="http://www.w3.org/1999/xhtml" lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo') - Respira</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}" />
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('ubicaciones') }}">Lista de ubicaciones</a></li>
                <li><a href="{{ route('crear_ubicacion') }}">Crear nueva ubicación</a></li>
            </ul>
        </nav>
    </header>
    @yield('contenido')


    <footer>Hecho con 💛 por <a href="https://github.com/andresito87" target="_blank"><x-codicon-github /></a>
    </footer>
</body>

</html>
