<?php

define('ARCHIVO', 'datos.csv');

function leerEstados()
{
    if (! file_exists(ARCHIVO))
        return false;
    $file = fopen(ARCHIVO, 'r');
    if (! $file)
        return false;

    fgetcsv($file); //Descartamos cabecera
    $estados = []; //Creamos array para almacenar los estados
    while ($datos = fgetcsv($file)) //Leemos fila a fila 
    {
        $estado = $datos[1]; //Nos quedamos con la fila 1
        //La insertamos en el array si no está previamente
        if (! in_array($estado, $estados))
            $estados[] = $estado;
    }
    fclose($file);//Cerramos el archivo.

    //Nota: también se podría haber implementado con array_column y array_unique

    return $estados;
}

function alAzar($estado)
{
    if (! file_exists(ARCHIVO))
        return false;
    $file = fopen(ARCHIVO, 'r');
    if (! $file)
        return false;

    fgetcsv($file); //Descartamos cabecera
    $frases = []; //Cargamos aquí las frases del estado
    while ($datos = fgetcsv($file)) //Leemos fila a fila el archivo
    {
        $estado_frase = $datos[1];
        if ($estado_frase == $estado)
            $frases[] = $datos[2];
    }
    fclose($file);
    if (! $frases)
        return false;
    else
        return $frases[array_rand($frases)];
    //Nota: también se podría haber usado: $frases[rand(0,count($frases))]; para obtener el elemento aleatorio.
}