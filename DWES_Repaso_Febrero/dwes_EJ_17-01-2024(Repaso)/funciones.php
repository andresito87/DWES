<?php

function cargarCSV(string $file):array|bool
{
    $array=[];
    if (!file_exists($file)) return false;
    $archivo=fopen($file,'r');
    while($fila=fgetcsv($archivo))
    {
        if (empty($cabecera))
        {
            $cabecera=$fila;
            continue;
        }
        if (count($fila)==count($cabecera))
            $array[]=array_combine($cabecera,$fila);
    }
    return $array;
}

function subconjunto(array $datos, int $inicio, int $length):array
{    
    $cont=0;
    $nuevo_array=[];
    foreach($datos as $key=>$val)
    {
        if ($cont>=$inicio && $cont<$inicio+$length)
        {
            $nuevo_array[$key]=$val;
        }
        $cont++;
        if ($cont>=$inicio+$length) break;
    }
    return $nuevo_array;    
}

function ordenar (array $array,string $nombreColumna):array
{
    $columna=array_column($array,$nombreColumna);
    array_multisort($columna,SORT_ASC,$array);
    return $array;
}

function filtrar (array $array, string $categoria):array
{
    /*    
    $arrayres=[];
    foreach($array as $key=>$val)
    {
        if ($val['Categoría']==$categoria)
            $arrayres[]=$val;
    }
    return $arrayres;
    */
    return array_filter($array, fn($val)=>$val['Categoría']===$categoria);
}