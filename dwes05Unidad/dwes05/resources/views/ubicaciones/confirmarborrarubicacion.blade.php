@extends('layouts.base')
@section('titulo', 'Confirmar borrado de ubicación')
@section('contenido')
    @if ($errors->any())
        <div class="errores">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h3>Debe confirmar la eliminación para continuar, dado que se borrarán también todos los talleres de esta ubicación:
    </h3>
    <form action="{{ route('borrar_ubicacion', ['ubicacion' => $ubicacion->id]) }}" method="post">
        @csrf
        <p><input type="radio" name="confirmar" value="si">Sí, quiero borrar esta ubicación y los talleres.</input></p>
        <p><input type="radio" name="confirmar" value="no" checked>No, no quiero borrar la ubicación.</input></p>
        <input type="submit" value="Borrar"></input>
    </form>
@endsection
