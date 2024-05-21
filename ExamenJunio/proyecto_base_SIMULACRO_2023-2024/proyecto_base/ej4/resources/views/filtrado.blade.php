<div>
    <h1>Lista de Videojuegos Filtrados</h1>
    <ul>
        @foreach ($videojuegos as $videojuego)
            <li>{{ $videojuego['nombre'] }} - {{ $videojuego['anyo_lanzamiento'] }}</li>
        @endforeach
    </ul>

</div>
