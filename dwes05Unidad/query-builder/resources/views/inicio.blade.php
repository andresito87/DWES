@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')

    <nav>
        Inicio |
        <a href='{{ route('obras-musicales') }}'>Canciones</a> |
        <a href='{{ route('anadir') }}'>Añadir</a>
    </nav>

    <h2>Inicio</h2>

    <p>Web de ejemplo que muestra y añade canciones en una base de datos.</p>

@endsection
