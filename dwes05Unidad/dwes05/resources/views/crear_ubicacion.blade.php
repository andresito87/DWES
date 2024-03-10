@extends('layouts.base')
@section('titulo', 'Formulario de creación de ubicación')
@section('contenido')
    @if ($errors->any())
        <div class="errores">
            <h3>¡¡¡ Errores !!!</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/ubicaciones/store" method="post">
        @csrf
        <label for="nombre">Nombre
            <input type="text" name="nombre" value="{{ !$errors->has('nombre') ? old('nombre') : '' }}"></label>
        <label for="descripcion">Descripción
            <input type="text" name="descripcion"
                value="{{ !$errors->has('descripcion') ? old('descripcion') : '' }}"></label>
        <label for="dias">Días en los que está disponible:
            @foreach (['L', 'M', 'X', 'J', 'V', 'S', 'D'] as $dia)
                {{ $dia }} <input type="checkbox" name="dias[]" value="{{ $dia }}"
                    @if (is_array(old('dias')) && in_array($dia, old('dias'))) checked @endif>
            @endforeach
        </label>
        <input type="submit" value="Crear nueva ubicación">
    </form>
@endsection
