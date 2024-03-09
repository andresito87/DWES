@extends('layouts.app')

@section('titulo', 'Insertar')

@section('contenido')

    <nav>
        <a href='{{ route('principal') }}'>Inicio</a> |
        <a href='{{ route('obras-musicales') }}'>Canciones</a> |
        Añadir
    </nav>

    <h2>Añadir una nueva canción</h2>

    <p>Página que para insertar una canción en la base de datos.</p>

    <form method='post' action='{{ route('guardar') }}'>
        @csrf
        <label>Título:</label>
        <input type='text' name='title' required='required'><br />
        <label>Artista:</label>
        <input type='text' name='artist' required='required'><br />
        <label>Año:</label>
        <input type='date' name='launch' required='required'><br />
        <label>Género:</label>
        <input type='text' name='genre' required='required'><br />
        <label>Duración:</label>
        <input type='number' name='duration' required='required'><br /><br />
        <input type='submit' value='Enviar'>
    </form>

@endsection
