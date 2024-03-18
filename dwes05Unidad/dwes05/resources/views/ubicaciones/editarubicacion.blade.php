@extends('layouts.base')
@section('titulo', 'Actualizar ubicación')
@section('contenido')
    @if ($errors->any())
        <div class="errores">
            <h3>¡¡¡ Errores !!!</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    @if (strpos($error, 'dias.') !== false)
                        <li>{{ str_replace(['dias.0', 'dias.1', 'dias.2', 'dias.3', 'dias.4', 'dias.5', 'dias.6'], 'dia', $error) }}
                        </li>
                    @else
                        <li>{{ $error }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('actualizar_ubicacion', ['ubicacion' => $ubicacion->id]) }}" method="post">
        @csrf
        <p><strong>Nombre:</strong> <input dusk="nombre" type="text" name="nombre" value="{{ $ubicacion->nombre }}"></p>
        <p><strong>Descripción:</strong> <input type="text" name="descripcion" value="{{ $ubicacion->descripcion }}"></p>
        <p><strong>Días: </strong>
            @foreach (['L', 'M', 'X', 'J', 'V', 'S', 'D'] as $dia)
                {{ $dia }} <input type="checkbox" name="dias[]" value="{{ $dia }}"
                    @if (in_array($dia, explode(',', $ubicacion->dias))) checked @endif>
            @endforeach
        </p>
        <input type="submit" value="Actualizar">
    </form>
@endsection
