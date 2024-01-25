<?php
/*6. Emplea `urlencode` para enviar datos a través de una URL y recogerlos en otra página PHP.*/
$nombre = "Juan";
$apellido = "García";
$edad = 20;
$ciudad = "Madrid";
?>
<form action="ejercicio6b.php" method="get">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo urlencode($nombre); ?>"><br>
    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" id="apellido" value="<?php echo urlencode($apellido); ?>"><br>
    <label for="edad">Edad:</label>
    <input type="text" name="edad" id="edad" value="<?php echo urlencode($edad); ?>"><br>
    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" id="ciudad" value="<?php echo urlencode($ciudad); ?>"><br>
    <input type="submit" value="Enviar">
</form>