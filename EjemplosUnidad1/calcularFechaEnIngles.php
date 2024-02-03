<?php

function calcularFechaEnIngles()
{

    $numero_mes = date("m");

    $numero_dia_semana = date("N");

    switch ($numero_mes) {

        case 1:
            $mes = "January";

            break;

        case 2:
            $mes = "February";

            break;

        case 3:
            $mes = "March";

            break;

        case 4:
            $mes = "April";

            break;

        case 5:
            $mes = "May";

            break;

        case 6:
            $mes = "June";

            break;

        case 7:
            $mes = "July";

            break;

        case 8:
            $mes = "August";

            break;

        case 9:
            $mes = "September";

            break;

        case 10:
            $mes = "October";

            break;

        case 11:
            $mes = "November";

            break;

        case 12:
            $mes = "December";

            break;
    }

    switch ($numero_dia_semana) {

        case 1:
            $dia_semana = "Monday";

            break;

        case 2:
            $dia_semana = "Tuesday";

            break;

        case 3:
            $dia_semana = "Wednesday";

            break;

        case 4:
            $dia_semana = "Thursday";

            break;

        case 5:
            $dia_semana = "Friday";

            break;

        case 6:
            $dia_semana = "Saturday";

            break;

        case 7:
            $dia_semana = "Sunday";

            break;
    }

    return $dia_semana . ", " . date("d") . " of " . $mes . " of " . date("Y");

}