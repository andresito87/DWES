<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">

    <title>Bienvenido a la asociación Respira</title>

</head>

<body>

    <h1>Bienvenido a la asociación Respira</h1>

    <a href="{{ url('/') }}/ubicaciones">Lista de Ubicaciones</a>

    <a href="{{ url('/') }}/talleres">Lista de Talleres</a>

</body>

</html>
