<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Usuario</title>
</head>

<body>
    <h1>Formulario de Usuario</h1>
    <form action="procesar.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required><br>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>