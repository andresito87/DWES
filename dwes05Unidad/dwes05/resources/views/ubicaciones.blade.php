@extends('layouts.base')
@section('titulo', 'Lista de ubicaciones')
@section('contenido')
    @if (session('mensaje') && session('tipo') == 'exito')
        <div class="mensaje-exito">
            {{ session('mensaje') }}
        </div>
    @elseif (session('mensaje') && session('tipo') == 'informativo')
        <div class="informativo">
            {{ session('mensaje') }}
        </div>
    @endif
    @if ($ubicaciones->isEmpty())
        <h3>No hay ubicaciones registradas en la Base de Datos</h3>
    @else
        <table class="ubicaciones">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Días</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ubicaciones as $ubicacion)
                    <tr>
                        <td>{{ $ubicacion->id }}</td>
                        <td>{{ $ubicacion->nombre }}</td>
                        <td>{{ $ubicacion->descripcion }}</td>
                        <td>{{ $ubicacion->dias }}</td>
                        <td>
                            <a href="{{ route('detalles_ubicacion', $ubicacion->id) }}">Detalles Ubicación</a>
                            <a href="{{ route('editar_ubicacion', $ubicacion->id) }}">Editar Ubicación</a>
                            <a href="{{ route('confirmar_borrar_ubicacion', $ubicacion->id) }}">Borrar Ubicación</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $ubicaciones->links() }}
    @endif
@endsection
