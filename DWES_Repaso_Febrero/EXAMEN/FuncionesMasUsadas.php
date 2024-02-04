<?php

echo "<br><br>HTML Entites<br>";
$str = "A 'quote' is <b>bold</b>";
// Outputs: A 'quote' is &lt;b&gt;bold&lt;/b&gt;
echo htmlentities($str);

/*---------------------------------------------------------------------------------------*/

echo "<br><br>READFILE<br>";
$nombreArchivo = 'ejemplo.txt';
// Verificar si el archivo existe
if (file_exists($nombreArchivo)) {
    // Leer y enviar el contenido del archivo al navegador
    readfile($nombreArchivo);
} else {
    // El archivo no existe
    echo 'El archivo no existe.';
}

/*---------------------------------------------------------------------------------------*/
echo "<br><br>FOPEN,FPUTCSV,FCLOSE,FGETCSV<br>";
//Sirve para abrir un archivo, devuelve el archivo en forma de recurso o flujo para trabajar
//$archivo = fopen('datos.csv', 'r'); solo lectura
//$archivo = fopen('datos.csv', 'r+'); lectura y escritura
/*$archivo = fopen('datos.csv', 'a'); //solo escritura
if ($archivo === false) {
echo '<H3>ERROR: no se ha podido abrir el archivo datos.csv</H3>';
} else {
fputcsv($archivo, $datos);
fclose($archivo);
echo "<H3>Datos guardados</H3>";
}*/

/*Función para cargar datos de un csv
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
}*/

/*---------------------------------------------------------------------------------------*/

//ARRAYWALK
// Función de ejemplo que eleva al cuadrado cada elemento del array
echo "ArrayWalk: Numeros al Cuadrado<br>";
function elevarAlCuadrado(&$valor, $clave)
{
    $valor = $valor * $valor;
}
$numeros = array(1, 2, 3, 4, 5);
// Aplicar la función elevarAlCuadrado a cada elemento del array
array_walk($numeros, 'elevarAlCuadrado');
// Imprimir el array después de aplicar la función
array_walk($numeros, function ($e) {
    echo $e . " ";
});

/*---------------------------------------------------------------------------------------*/

echo "<br><br>ARRAYCOLUM<br>";
$usuarios[] = ['nombre' => 'Andrés', 'edad' => '23'];
$usuarios[] = ['nombre' => 'Sandra', 'edad' => '18'];
$usuarios[] = ['nombre' => 'Miguel', 'edad' => '34'];
$edades = array_column($usuarios, 'edad');
echo "Las edades de los usuarios son: ";
foreach ($edades as $edad) {
    echo $edad . ' ';
}

/*---------------------------------------------------------------------------------------*/

echo "<br><br>ARRAYSEARCH<br>";
define('SECCION_DEFECTO', 'Principal');
$secciones = [];
//readfile va a leer directamente el contenido del archivo
$secciones[] = ['nombre' => 'Contacto', 'link' => 'ver contactos', 'contenido' => 'aquí se mostrará una lista de contactos'];
$secciones[] = ['nombre' => 'Desarrollador', 'link' => 'ver desarrollador', 'archivo' => 'fragmentos/desarrollador.html'];
$secciones[] = ['nombre' => 'Principal', 'link' => 'ver contenido principal', 'archivo' => 'fragmentos/principal.html'];
//Devuelve la primera key del valor buscado en la dimensión o columna del array sobre la que se realiza la busqueda
$posSeccionDefecto = array_search(SECCION_DEFECTO, array_column($secciones, 'nombre'));
echo "Posición " . $posSeccionDefecto;

/*---------------------------------------------------------------------------------------*/

echo "<br><br>IN_ARRAY:<br>";
//Comprueba los valores en el array unidimensional
$existeEdad = false;
$edad = '18';
foreach ($usuarios as $usuario) {
    if (in_array($edad, $usuario)) {
        $existeEdad = true;
        break; // Puedes salir del bucle una vez que encuentres la edad
    }
}
echo ($existeEdad ? "Sí existe $edad" : "No existe $edad");

/*---------------------------------------------------------------------------------------*/

echo "<br><br>IS_ARRAY:<br>";
//Devuelve si el elemento es un array
echo "Usuarios " . (is_array($usuarios) ? "sí" : "no") . " es un array";

/*---------------------------------------------------------------------------------------*/

echo "<br><br>ARRAY_DIFF<br>";
//Compara valores de dos arrays o más arrays y devuelve todos los elementos del primer array que no estén en los otros
$array1 = array("a" => "verde", "rojo", "azul", "rojo");
$array2 = array("b" => "verde", "amarillo", "rojo");
var_dump(array_diff($array1, $array2)); // Muestra blue

/*---------------------------------------------------------------------------------------*/

echo "<br><br>COUNT<br>";
//devuelve la cantidad de elementos de un array u objeto(Contable)
echo "Nuestro sistema tiene " . count($usuarios) . " usuarios";

/*---------------------------------------------------------------------------------------*/

echo "<br><br>IMPLODE<br>";
//Une elementos de un array en un String o cadena
$array = ['a', 'b', 'c'];
var_dump($array);
echo "<br> El array transformado a cadena es " . implode(',', $array);

/*---------------------------------------------------------------------------------------*/

echo "<br><br>EXPLODE<br>";
$colores = "Negro Rojo Blanco Azul";
echo "Transformando la cadena $colores en array...<br>";
$arrayColores = explode(' ', $colores);
print_r($arrayColores);

/*---------------------------------------------------------------------------------------*/

echo "<br><br>ARRAY_COMBINE<br>";
$cabecera = array('ciudad', 'provincia', 'país');
$datos = array('Benálmadena', 'Málaga', 'España');
$arraysCombinados = array_combine($cabecera, $datos);

print_r($arraysCombinados);

/*---------------------------------------------------------------------------------------*/

echo "<br><br>ARRAY_FILL<br>";
//Sirve para crear un array con las dimesiones y los valores deseados
$registrosDeVenta = ['PorProvincia', 'PorCCAA', 'PorPaís'];
$datos = array_fill(0, count($registrosDeVenta), 0);
var_dump($datos); //Muestra 0 0 0

//array_flip: Volveta un array, convirtiendo las claves en valores y los valores en claves


//array_intersect_key: array_intersect_key(array $array1, array $array2, array $... = ?): array
//Devuelve un array con todos los pares valor de array1 cuyas claves estén presentes en el resto de arrays con los que se compara


/*---------------------------------------------------------------------------------------*/

echo "<br><br>FILE_EXISTS<br>";
echo file_exists("FuncionesMasUsadas.php") ? "Sí existe el archivo" : "No existe el archivo";

/*---------------------------------------------------------------------------------------*/

echo "<br><br>Fecha y hora del documento: ";
echo date('d/m/Y h:m', filemtime("."));

/*---------------------------------------------------------------------------------------*/

echo "<br><br>Transformar fecha 02/03/2024 de string a UNIX Timestamp para ser almacenada en Base de datos:<br>T";
echo strtotime("02/03/2024");

/*---------------------------------------------------------------------------------------*/

echo "<br><br>STRLEN de abcdef<br>";
$str = 'abcdef';
echo strlen($str); // 6

/*---------------------------------------------------------------------------------------*/

//IS_NULL
//EMPTY
//ISSET
//IS_STRING
//IS_INT
//checkdate($mes,$dia,$anyo) Verifica si una fecha es válida temporalmente
/*FILTER_INPUT:
filter_input(INPUT_POST, 'confirmado',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$idusuario = filter_input(INPUT_POST, 'idusuario', FILTER_VALIDATE_INT);
$datos['fecha_espanol'] = filter_input(INPUT_POST, 'fecha', FILTER_VALIDATE_REGEXP, REGEX_VALIDATE_FECHA);
//exit() Acabamos la ejecucion del script
*/
//DEFINE
// require, require_once, include
//?? Coalencencia nula $ver=$_GET['ver']??null;
//$_GET, $_POST, $_SESSION
//preg_match,preg_split
/*Expresiones regulares:
define ('REGEX_VALIDATE_FECHA',['options'=>['regexp'=>'/^(0[1-9]|[12][0-9]|[3][01])([-\/\.])([0][1-9]|[1][012])\2([0-9]{4})$/']]);
define ('DATE_SPLIT','[-\/\.]');
define ('REGEX_VALIDATE_HORA',['options'=>['regexp'=>'/^(?:[0-1][0-9]|2[0-3]):[0-5][0-9]$/']]);
*/