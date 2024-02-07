<?php

function cargarCSV(string $file): array|bool
{
    $array = [];
    if (!file_exists($file)) return false;
    $archivo = fopen($file, 'r');
    while ($fila = fgetcsv($archivo)) {
        //coge la cabecera
        if (empty($cabecera)) {
            $cabecera = $fila;
            continue;
        }
        //coge el resto de filas
        if (count($fila) == count($cabecera))
            $array[] = array_combine($cabecera, $fila);
    }
    return $array;
}

function subconjunto(array $datos, int $inicio, int $length): array
{
    $cont = 0;
    $nuevo_array = [];
    foreach ($datos as $key => $val) {
        if ($cont >= $inicio && $cont < $inicio + $length) {
            $nuevo_array[$key] = $val;
        }
        $cont++;
        if ($cont >= $inicio + $length) break;
    }
    return $nuevo_array;
}

function ordenar(array $array, string $nombreColumna): array|string
{
    $columna = array_column($array, $nombreColumna);
    if (!empty($columna)) {
        array_multisort($columna, SORT_ASC, $array);
        return $array;
    }
    return "Columna no encontrada";
}

function filtrar(array $array, string $categoria): array
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
    return array_filter($array, fn ($val) => $val['Categoría'] == $categoria);
}

function mostrarDatos($array)
{
    echo "<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Categoria</th>
        </tr>
    </thead>";

    foreach ($array as $registro) {
        echo "<tr>
            <td>" . $registro["ID"] . "</td>
            <td>" . $registro['Nombre'] . "</td>
            <td>" . $registro['Precio'] . "</td>
            <td>" . $registro['Categoría'] . "</td>
        </tr>";
    }

    echo "</table>";
}
