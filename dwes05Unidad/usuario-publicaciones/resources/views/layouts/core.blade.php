<html xmlns='http://www.w3.org/1999/xhtml' lang='es'>

<head>
    <meta charset='utf-8' />
    <title>@yield('title') - Publicaciones y usuarios</title>
    <link rel='stylesheet' href='{{ asset('css/estilo.css') }}'>
</head>

<body>
    <h1>Publicaciones y usuarios</h1>

    <nav>
        @if (Route::is('principal'))
            Inicio |
        @else
            <a href='{{ route('principal') }}'>Inicio</a> |
        @endif

        @if (Route::is('posts.index'))
            Ver |
        @else
            <a href='{{ route('posts.index') }}'>Ver</a> |
        @endif

        @if (Route::is('posts.create'))
            Añadir |
        @else
            <a href='{{ route('posts.create') }}'>Añadir</a> |
        @endif

        @if (Route::is('posts.edit.select'))
            Editar |
        @else
            <a href='{{ route('posts.edit.select') }}'>Editar</a> |
        @endif

        @if (Route::is('posts.delete.select'))
            Borrar
        @else
            <a href='{{ route('posts.delete.select') }}'>Borrar</a>
        @endif

        <span>
            @auth
                {{ Auth::user()->name }} |
                <a href='{{ route('dashboard') }}'>Mi cuenta</a>
            @else
                <a href='{{ route('login') }}'>Iniciar sesión</a> |
                <a href='{{ route('register') }}'>Crear cuenta</a>
            @endauth
        </span>
    </nav>

    @yield('content')

    <footer>Sitio web de elaboración propia.</footer>

</body>

</html>
