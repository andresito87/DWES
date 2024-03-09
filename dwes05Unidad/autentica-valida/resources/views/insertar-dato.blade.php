<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml' lang='es'>

<head>
    <meta charset='utf-8' />
    <title>Ejemplo de validación</title>
</head>

<body>
    <h1>Ejemplo de validación</h1>

    <form action='/validar' method='post'>
        @csrf
        <input type='text' name='dato' />
        <input type='submit' value='Enviar' />
    </form>

</body>

</html>
