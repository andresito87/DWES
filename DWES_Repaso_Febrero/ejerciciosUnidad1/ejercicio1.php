<?php
/*1. Crea una página PHP que muestre la fecha y hora actual.*/
echo DateTime::createFromFormat('U.u', microtime(true))->format('Y-m-d H:i');
echo "<br>";
echo date('Y-m-d H:i');
?>
