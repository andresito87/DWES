<?php

function fechaHoraActual()
{
    $fecha=date('Y-m-d H:i');
    return DateTime::createFromFormat('Y-m-d H:i', $fecha)->format('d/m/Y H:i');
}

return fechaHoraActual();