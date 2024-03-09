@extends('layouts.base')
@section('titulo', 'Lista de ubicaciones')
@if (session('mensaje'))
    <div class="alert alert-success">
        {{ session('mensaje') }}
    </div>
@endif
@section('contenido')
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Días</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ubicaciones as $ubicacion)
                <tr>
                    <td>{{ $ubicacion->id }}</td>
                    <td>{{ $ubicacion->nombre }}</td>
                    <td>{{ $ubicacion->descripcion }}</td>
                    <td>{{ $ubicacion->dias }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
