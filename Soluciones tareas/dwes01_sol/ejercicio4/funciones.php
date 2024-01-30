<?php
/**
 * Comentario a completar por cada alumno/a
 * @param $filename ...
 * @param $headers ...
 * @return ...
 */
function cargar_archivo($filename,$headers=['codigo_postal', 'sexo', 'curso', 'rama', 'asgs', 'tiempolibre'])
{
    $data = [];    
    $file = fopen($filename, "r");
    if ($file !== false) {
        while (($row = fgetcsv($file)) !== false) {
            if (count($row)==count($headers))
            {
                $row[4]=explode("-", $row[4]);
                $row[5]=explode("-", $row[5]);
                $data[]=array_combine($headers,$row);
            }                
        }
        fclose($file);        
    }
    return $data;
}

/**
 * Comentario a completar por cada alumno/a
 * @param $curso ...
 * @param $conjunto ...
 * @return ...
 */
function filtrar_por_curso($curso,$conjunto)
{
    $subconjunto=[];
    foreach($conjunto as $fila)
    {
        if ($fila['curso']===$curso)
            $subconjunto[]=$fila;
    }
    return $subconjunto;
}

/**
 * Comentario a completar por cada alumno/a
 * @param $conjunto ...
 * @param $asignaturas_validas ...
 * @return ...
 */
function resumen($conjunto,$asignaturas_validas=['LCL','M','BG','GH','FQ','I'])
{
    $resumen=array_combine($asignaturas_validas,array_fill(0,count($asignaturas_validas),0));
    foreach ($conjunto as $fila)
    {
        if (!isset($fila['asgs']) || empty($fila['asgs'])) continue;
        foreach($fila['asgs'] as $asg)
        {
            if (isset($resumen[$asg])) $resumen[$asg]++;
        }
    }
    return $resumen;
}
