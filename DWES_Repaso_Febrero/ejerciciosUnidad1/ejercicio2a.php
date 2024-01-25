<?php
$fechaHoraActuales=require_once 'ejercicio2b.php';
$datos['dia']= explode('/', $fechaHoraActuales)[0];
$datos['mes']= explode('/', $fechaHoraActuales)[1];
$datos['anio']= explode('/', $fechaHoraActuales)[2];
$datos['hora']= explode(' ', explode(':', $fechaHoraActuales)[0])[1];
$datos['minutos']= explode(' ', explode(':', $fechaHoraActuales)[1])[0];

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fecha y hora actuales</title>
</head>
<body>
<h2>Fecha y hora actuales</h2>
<p>Estamos en el dia <?php echo $datos['dia'] ?> del mes <?php echo $datos['mes'] ?> del año <?php echo $datos['anio'] ?></p>
<p>Son las <?php echo $datos['hora'] ?> horas y <?php echo $datos['minutos'] ?> minutos</p>
</body>
</html>