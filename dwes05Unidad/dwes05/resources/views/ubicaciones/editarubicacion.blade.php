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
    <x-formulario :action="route('actualizar_ubicacion', $ubicacion->id)" :csrf="true">
        <x-slot name="titulo">Actualizar ubicación</x-slot>
        <x-slot name="campos">
            <x-label :for="'nombre'">
                Nombre
                <x-input :type="'text'" :name="'nombre'" :value="!$errors->has('nombre') ? $ubicacion->nombre : old('nombre')" :checked="'no'" />
            </x-label>
            <x-label :for="'descripcion'">
                Descripción
                <x-input :type="'text'" :name="'descripcion'" :value="!$errors->has('descripcion') ? $ubicacion->descripcion : old('descripcion')" :checked="'no'" />
            </x-label>
            <x-label :for="'dias'">
                Días en los que está disponible:
                @foreach (['L', 'M', 'X', 'J', 'V', 'S', 'D'] as $dia)
                    {{ $dia }}
                    <x-input :type="'checkbox'" :name="'dias[]'" :value="$dia" :checked="!$errors->has('dias') && in_array($dia, explode(',', $ubicacion->dias))" />
                @endforeach
            </x-label>
        </x-slot>
        <x-slot name="boton">
            <x-input :type="'submit'" :name="'enviar'" :value="'Actualizar'" :checked="'no'" />
        </x-slot>
    </x-formulario>
@endsection
