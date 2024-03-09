@extends('layouts.core')

@section('title', 'Editar')

@section('content')

    <h2>Editar</h2>

    <form method='post' action='{{ route('posts.update', $post->id) }}'>
        @csrf
        @method('put')
        <label>Título:</label>
        <input type='text' name='title' value='{{ $post->title }}' required='required' /><br />
        <label>Cuerpo:</label>
        <input type='text' name='body' size='50' value='{{ $post->body }}' required='required' /><br /><br />
        <input type='submit' value='Enviar' />
    </form>

@endsection
