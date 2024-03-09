@extends('layouts.core')

@section('title', 'Insertar')

@section('content')

    <h2>Insertar una nueva publicación</h2>

    <form method='post' action='{{ route('posts.store') }}'>
        @csrf
        <label>Título:</label>
        <input type='text' name='title' required='required' /><br />
        <label>Cuerpo:</label>
        <input type='text' size='50' name='body' required='required' />
        <br /><br />
        <input type='submit' value='Enviar' />
    </form>

@endsection
