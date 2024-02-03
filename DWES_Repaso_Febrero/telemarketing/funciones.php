<?php

/*

$_SESSION['datos'][0]=['nombre' => '...', 'telefono' => '....']
$_SESSION['datos'][1]=['nombre' => '...', 'telefono' => '....']
$_SESSION['datos'][2]=['nombre' => '...', 'telefono' => '....']
*/
function extraeDatos($cadena)
{
    $registros = preg_split('/(?<=\d)([;:,-]|\s)+/', $cadena);
    $datos = [];
    foreach ($registros as $registro) {
        $matches = [];
        $coincide = preg_match('/(?:\[|\()((?:\s|\w|\d)+)(?:\]|\))\s*(\d+)/', $registro, $matches);
        if ($coincide) {
            $datos[] = ['nombre' => $matches[1], 'telefono' => $matches[2]];
        }
    }
    return $datos;
}

function addToSession ($datos)
{
    if (!isset($_SESSION['datos']) ||empty ($_SESSION['datos']))
    {
        $_SESSION['datos']=$datos;
    }
    else
    {
        foreach ($datos as $registro)
        {
            $telefonos=array_column($_SESSION['datos'],'telefono');            
            if (!in_array($registro['telefono'],$telefonos))
            {
                $_SESSION['datos'][]=$registro;
            }
        }
    }
}


/**
 * $elementosAEliminar=[0,2,5];
 */
function borrarTelefonos ($elementosAEliminar)
{
    $datos=[];
    foreach( $_SESSION['datos'] as $key=>$registro)
    {
        if (!in_array($key,$elementosAEliminar))
        {
            $datos[]=$registro;
        }
    }
    $_SESSION['datos']=$datos;
}

function guardarTelefonos(PDO $pdo)
{
    if (!isset($_SESSION['datos']) || empty($_SESSION['datos'])) return -1;
    $sql="INSERT INTO usuarios (nombre,telefono) values (:nombre, :telefono)";
    $stmt=$pdo->prepare($sql);
    $noRegistrado=[];

    foreach($_SESSION['datos'] as $registro)
    {
        try {
            $stmt->execute($registro);
        }
        catch (PDOException $e)
        {
            if ($e->getCode()=='23000') $noRegistrado[]=$registro['telefono'];                        
        }
    }
    
    return $noRegistrado;
}