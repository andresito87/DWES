<?php
// Si el usuario no ha pulsado el botón de "Siguiente" del formulario anterior, 
// redirigirlo a index.php
if (!isset($_POST["Siguiente"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respira - Formulario (Parte 2)</title>
</head>

<body>
    <form action="save.php" method="post">
        <div>
            Señala las asignaturas que te resulten más complicadas:<br><br>

            <label><input type="checkbox" name="asgs[]" value="LCL"> Lengua Castellana y Literatura. </label><BR>
            <label><input type="checkbox" name="asgs[]" value="M"> Matemáticas. </label><br>
            <!-- Esta opción no deberá mostrarse si el usuario selecciono 2ESO -->
            <?php
            if ($_POST["curso"] !== "2ESO") {
                echo '<label><input type="checkbox" name="asgs[]" value="BG"> Biología y Geología.</label><BR>';
            }
            ?>
            <label><input type="checkbox" name="asgs[]" value="GH"> Geografía e Historia. </label><BR>
            <label><input type="checkbox" name="asgs[]" value="FQ"> Física y Química. </label><BR>
            <label><input type="checkbox" name="asgs[]" value="I"> Inglés. </label><br>
        </div>

        <br>
        <label for="tiempolibre">Selecciona aquellas opciones a las que que dedicas tu tiempo libre (3 horas o más a la
            semana):</label><BR>
        <select id="tiempolibre" name="tiempolibre[]" multiple size="8">
            <option value="deportes">Práctico deportes</option>
            <option value="musica">Toco instrumentos musicales</option>
            <option value="danza">Práctico danza</option>
            <option value="art">Práctico actividades artísticas: teatro, pintura, etc.</option>
            <option value="vjuegos">Juego a video juegos </option>
            <option value="television">Veo la televisión</option>
            <option value="dom">Realizo tareas domésticas: limpiar, cocinar, etc. </option>
            <option value="lectura">Leo libros, cómics, revistas, etc. (sin contar los libros del instituto)</option>
        </select><br>
        <small>Nota: pulsa Ctrl+click para seleccionar más de una opción</small>
        <br>
        <?php
        if (isset($_POST["codigo_postal"])) {
            echo '<input type="hidden" name="codigo_postal" value="' . htmlspecialchars($_POST["codigo_postal"]) . '">';
        }

        if (isset($_POST["sexo"])) {
            echo '<input type="hidden" name="sexo" value="' . htmlspecialchars($_POST["sexo"]) . '">';
        }
        if (isset($_POST["curso"])) {
            echo '<input type="hidden" name="curso" value="' . htmlspecialchars($_POST["curso"]) . '">';
        }
        if (isset($_POST["rama"])) {
            echo '<input type="hidden" name="rama" value="' . htmlspecialchars($_POST["rama"]) . '">';
        }
        ?>
        <input type="submit" name="Terminar" value="Terminar">
    </form>
</body>

</html>