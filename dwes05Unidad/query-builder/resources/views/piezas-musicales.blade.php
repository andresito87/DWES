@extends('layouts.app')

@section('titulo', 'Canciones')

@section('contenido')

    <nav>
        <a href='{{ route('principal') }}'>Inicio</a> |
        Canciones |
        <a href='{{ route('anadir') }}'>Añadir</a>
    </nav>

    <h2>Canciones</h2>

    <p>Tabla con las canciones favoritas insertadas en la base de datos.</p>

    @if (count($canciones) > 0)

        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Artista</th>
                    <th>Año</th>
                    <th>Género</th>
                    <th>Duración</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($canciones as $cancion)
                    <tr>
                        <td>{{ $cancion->titulo }}</td>
                        <td>{{ $cancion->artista }}</td>
                        <td>{{ $cancion->lanzamiento }}</td>
                        <td>{{ $cancion->genero }}</td>
                        <td>{{ $cancion->duracion }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <p>¡No hay canciones favoritas añadidas actualmente!</p>

    @endif

@endsection
