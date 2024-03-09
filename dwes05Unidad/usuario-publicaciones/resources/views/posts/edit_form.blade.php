@extends('layouts.core')

@section('title', 'Editar')

@section('content')

    <h2>Editar</h2>

    <form method='post' action='{{ route('posts.edit.select.submit') }}'>
        @csrf
        <label>ID:</label>
        <input type='number' name='id' required='required' /><br /><br />
        <input type='submit' value='Enviar' />
    </form>

@endsection
