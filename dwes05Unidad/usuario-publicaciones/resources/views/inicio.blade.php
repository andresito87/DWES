@extends('layouts.core')

@section('title', 'Inicio')

@section('content')

    <h2>Inicio</h2>

    @if (session('success'))
        <div class='alert alert-success'>
            {{ session('success') }}
        </div>
    @endif

    @if (session('failure'))
        <div class='alert alert-danger'>
            {{ session('failure') }}
        </div>
    @endif

    <p>Gestión de publicaciones con autenticación para dos roles.</p>

@endsection
