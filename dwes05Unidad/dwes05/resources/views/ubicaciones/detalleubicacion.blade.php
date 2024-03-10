@extends('layouts.base')
@section('titulo', 'Detalles de ubicación')
@section('contenido')
    <div class="detalles">
        <p><strong>Nombre:</strong> {{ $ubicacion->nombre }}</p>
        <p><strong>Descripción:</strong> {{ $ubicacion->descripcion }}</p>
        <p><strong>Días:</strong> {{ $ubicacion->dias }}</p>
    </div>
    @if ($ubicacion->talleres->isEmpty())
        <h3>No hay talleres registrados en esta ubcación</h3>
    @else
        <h3>Lista de talleres:</h3>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Dia de la semana</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Cupo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ubicacion->talleres as $taller)
                    <tr>
                        <td>{{ $taller->nombre }}</td>
                        <td>{{ $taller->descripcion }}</td>
                        <td>{{ $taller->dia_semana }}</td>
                        <td>{{ $taller->hora_inicio }}</td>
                        <td>{{ $taller->hora_fin }}</td>
                        <td>{{ $taller->cupo_maximo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection
