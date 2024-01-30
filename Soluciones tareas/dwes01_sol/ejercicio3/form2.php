<?php
    $datos=[];
    foreach($_POST as $key=>$value) {    
        $datos[$key]=htmlspecialchars($value);    
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
 
    
    <form action="save.php" method="post">
        <div>
            Señala las asignaturas que te resulten más complicadas:<BR><BR>
    
            <label><input type="checkbox" name="asgs[]" value="LCL"> Lengua Castellana y Literatura. </label><BR>
            <label><input type="checkbox" name="asgs[]" value="M"> Matemáticas. </label><BR> 
            <?php if (isset($datos['curso']) && $datos['curso']!=='2ESO'): ?>
                <label><input type="checkbox" name="asgs[]" value="BG"> Biología y Geología.</label><BR>
            <?php endif; ?>
            <label><input type="checkbox" name="asgs[]" value="GH"> Geografía e Historia. </label><BR>
            <label><input type="checkbox" name="asgs[]" value="FQ"> Física y Química. </label><BR>
            <label><input type="checkbox" name="asgs[]" value="I"> Inglés. </label><BR>
        </div>
    
        <br>
        <label for="tiempolibre">Selecciona aquellas opciones a las que que dedicas tu tiempo libre (3 horas o más a la semana):</label><BR>
        <select id="tiempolibre" name="tiempolibre[]" multiple size="8">
            <option value="deportes">Práctico deportes</option>
            <option value="musica">Toco instrumentos musicales</option>
            <option value="danza">Práctico danza</option>
            <option value="art">Práctico actividades artísticas: teatro, pintura, etc.</option>
            <option value="vjuegos">Juego a video juegos </option>
            <option value="television">Veo la televisión</option>
            <option value="dom">Realizo tareas domésticas: limpiar, cocinar, etc. </option>
            <option value="lectura">Leo libros, cómics, revistas, etc. (sin contar los libros del instituto)</option>
        </select><BR>
        <small>Nota: pulsa Ctrl+click para seleccionar más de una opción</small>
        <BR>
        <input type="submit" value="Terminar">
        <?php foreach ($datos as $key => $value):?>            
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
        <?php endforeach;?>
    </form>
    
</body>
</html>