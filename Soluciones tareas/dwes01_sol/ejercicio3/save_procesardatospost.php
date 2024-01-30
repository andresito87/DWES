<?php

$errores=[];
$datos=[];

$asignaturas_validas=['LCL','M','BG','GH','FQ','I'];
$tiempolibre_validas=['deportes','musica','danza','art','vjuegos','television','dom','lectura'];

/// Procesamos el dato "CODIGO_POSTAL" recibido por POST
if (!isset($_POST['codigo_postal']))
{
    $errores[]="El código postal no se ha proporcionado.";
} 
else if (!preg_match('/^\d{5}$/',$_POST['codigo_postal']))
{
    $errores[]="El código postal no es válido.";
} else
{
    $datos['codigo_postal']=$_POST['codigo_postal'];
}

/// Procesamos el dato "SEXO" recibido por POST
if (!isset($_POST['sexo']))
{
    $errores[]="El sexo no se ha proporcionado.";
}
elseif (!in_array($_POST['sexo'],['M','F','O','N']))
{
    $errores[]="El sexo no es válido.";
}
else
{
    $datos['sexo']=$_POST['sexo'];
}

/// Procesamos el dato "CURSO" recibido por POST
if (!isset($_POST['curso']))
{
    $errores[]="El curso no se ha proporcionado.";
}
elseif (!in_array($_POST['curso'],['1ESO','2ESO','3ESO']))
{
    $errores[]="El curso no es válido.";
}
else
{
    $datos['curso']=$_POST['curso'];
    //Si el curso es 2ESO quito del array de asignaturas válidas la opción BG
    if ($datos['curso']==='2ESO')
        $asignaturas_validas=array_diff($asignaturas_validas,['BG']);
}

/// Procesamos el dato "RAMA" recibido por POST
if (!isset($_POST['rama']))
{
    $errores[]="La rama no se ha proporcionado.";
}
elseif (!in_array($_POST['rama'],['BCH','FP']))
{
    $errores[]="La rama no es válido.";
}
else
{
    $datos['rama']=$_POST['rama'];
}

/// Procesamos el dato "ASGS" recibido por POST
if (!isset($_POST['asgs'])) 
{
    //No es un dato obligatorio, si no se marca, se queda vacío
    $datos['asgs']="";
}
elseif (!is_array($_POST['asgs'])) {
    $errores[]="Error en el formato de dato de asignaturas (se esperaba un array).";
}
//NOTA: el array $asignaturas_validas se modifica en la línea 50 en función del curso
//      si el curso es "2ESO" se quita "BG"
elseif (count(array_diff($_POST['asgs'],$asignaturas_validas))>0) 
{
    $errores[]="Los datos de las asignaturas más complicadas está corrompido o no es válido.";
}
else
{
    $datos['asgs']=implode('-',$_POST['asgs']);
}

/// Procesamos el dato "tiempolibre" recibido por POST
if (!isset($_POST['tiempolibre'])) 
{
    //No es un dato obligatorio, si no se proporciona, se queda vacío
    $datos['tiempolibre']="";
}
elseif (!is_array($_POST['tiempolibre'])) {
    $errores[]="Error en el formato de las actividades de tiempo libre (se esperaba un array).";
}
elseif (count(array_diff($_POST['tiempolibre'],$tiempolibre_validas))>0)
{
    $errores[]="Los datos de las asignaturas más complicadas está corrompido o no es válido.";
}
else
{
    $datos['tiempolibre']=implode('-',$_POST['tiempolibre']);
}

return [$datos,$errores];