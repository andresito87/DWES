@extends('layouts.core')

@section('title', 'Posts')

@section('content')

    <h2>Publicaciones</h2>

    @if (session('success'))
        <div class='alert alert-success'>
            {{ session('success') }}
        </div>
    @endif

    <div>
        @if (Route::is('posts.index'))
            Ver todos |
        @else
            <a href='{{ route('posts.index') }}'>Ver todos</a>
        @endif

        @if (Route::is('posts.user'))
            | Mis publicaciones
        @else
            <a href='{{ route('posts.user') }}'>Mis publicaciones</a>
        @endif
    </div>

    @if (count($posts) > 0)

        @foreach ($posts as $post)
            <p>
                <strong>ID: </strong> {{ $post->id }}.
                <strong>Título: </strong> {{ $post->title }}.
                <strong>Cuerpo: </strong> {{ $post->body }}.
            </p>
        @endforeach
    @else
        <p>¡No hay publicaciones actualmente!</p>

    @endif

@endsection
