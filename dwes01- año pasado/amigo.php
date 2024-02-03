<?php
require_once('etc/conf.php');

$fecha = date_create(); //Día de hoy
$fechaTope = date_create_from_format('d/m/Y', FECHA_TOPE_AMIGO);

if ($fecha < $fechaTope) { ?>

    <div class='amigo'>
        Trae a tu amigo o amiga hasta el 11/12/2022 y consigue un 30% de descuento de por vida.
    </div>

<?php } ?>