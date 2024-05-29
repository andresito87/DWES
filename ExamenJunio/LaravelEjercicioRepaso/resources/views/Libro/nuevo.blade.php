<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario</title>
</head>

<body>

    @if ($errors->any())
        <h2>Errores</h2>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Formulario</h1>
    <form action="{{ route('crearLibro') }}" method="POST">
        @csrf <!-- Token de seguridad QUE NO SE OLVIDE-->
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo">
        <br>
        <label for="year">Año</label>
        <input type="text" name="year" id="year">
        <br>
        <label for="autor">Autor</label>
        <input type="text" name="autor" id="autor">
        <br>
        <input type="submit" value="Enviar">
    </form>

</body>

</html>
