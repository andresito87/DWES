<?php

/*******************************************************************************************************************************/
// ¡¡AVISO IMPORTANTE!!: La ejecución de este script puede provocar la pérdida o modificación de información en la base de datos.
/*******************************************************************************************************************************/

require_once __DIR__ . '/vendor/autoload.php';

use DWES04\models\Taller;
use DWES04\models\Talleres;
use DWES04\models\Peticion;
use DWES04\DB;

// Las pruebas de la clase DB no se realizan exhaustivamente, ya que se piden pruebas de clases que hemos creado nosotros mismos.
// Creacion de la conexión a la base de datos
$pdo = DB::obtenerConexion();

/********************************/
/***** PRUEBAS CLASE TALLER *****/
/********************************/
echo "<h3>Creando un nuevo taller</h3>";
$taller = new Taller();
$errores = [];
if (!$taller->setNombre("Taller de prueba")) {
    $errores[] = "Error en la asignación del nombre";
}

if (!$taller->setDescripcion("Descripción de prueba")) {
    $errores[] = "Error en la asignación de la descripción";
}

if (!$taller->setUbicacion("Ubicación de prueba")) {
    $errores[] = "Error en la asignación de la ubicación";
}

if (!$taller->setDiaSemana("Lunes")) {
    $errores[] = "Error en la asignación del día de la semana";
}

if (!$taller->setHoraInicio(new DateTime("08:00"))) {
    $errores[] = "Error en la asignación de la hora de inicio";
}

if (!$taller->setHoraFin(new DateTime("10:00"))) {
    $errores[] = "Error en la asignación de la hora de fin";
}

if (!$taller->setCupoMaximo(8)) {
    $errores[] = "Error en la asignación del cupo máximo";
}

if (count($errores) > 0) {
    echo "Errores en la creación del taller: <br>";
    foreach ($errores as $error) {
        echo $error . "<br>";
    }
    exit;
} else {
    //mostrar todos los datos del taller
    echo "Taller creado correctamente: <br>";
    echo "ID: " . ($taller->getId() ?? "nulo") . "<br>";
    echo "Nombre: " . $taller->getNombre() . "<br>";
    echo "Descripción: " . $taller->getDescripcion() . "<br>";
    echo "Ubicación: " . $taller->getUbicacion() . "<br>";
    echo "Día de la semana: " . $taller->getDiaSemana() . "<br>";
    echo "Hora de inicio: " . $taller->getHoraInicio()->format('H:i') . "<br>";
    echo "Hora de fin: " . $taller->getHoraFin()->format('H:i') . "<br>";
    echo "Cupo máximo: " . $taller->getCupoMaximo() . "<br>";
}

echo "<h3>Guardando el taller en la base de datos...</h3>";
if (!$taller->guardar($pdo)) {
    echo "Error al guardar el taller en la base de datos";
} else {
    echo "Taller guardado correctamente: <br>";
    echo "ID: " . $taller->getId() . "<br>";
    echo "Nombre: " . $taller->getNombre() . "<br>";
    echo "Descripción: " . $taller->getDescripcion() . "<br>";
    echo "Ubicación: " . $taller->getUbicacion() . "<br>";
    echo "Día de la semana: " . $taller->getDiaSemana() . "<br>";
    echo "Hora de inicio: " . $taller->getHoraInicio()->format('H:i') . "<br>";
    echo "Hora de fin: " . $taller->getHoraFin()->format('H:i') . "<br>";
    echo "Cupo máximo: " . $taller->getCupoMaximo() . "<br>";

}

$idTaller = $taller->getId();
echo "<h3>Rescatando taller con ID $idTaller...</h3>";
$tallerRescatado = Taller::rescatar($pdo, $idTaller);
if (!$tallerRescatado) {
    echo "Error al rescatar el taller con ID $idTaller.";
} else {
    echo "Taller rescatado correctamente: <br>";
    echo "ID: " . $tallerRescatado->getId() . "<br>";
    echo "Nombre: " . $tallerRescatado->getNombre() . "<br>";
    echo "Descripción: " . $tallerRescatado->getDescripcion() . "<br>";
    echo "Ubicación: " . $tallerRescatado->getUbicacion() . "<br>";
    echo "Día de la semana: " . $tallerRescatado->getDiaSemana() . "<br>";
    echo "Hora de inicio: " . $tallerRescatado->getHoraInicio()->format('H:i') . "<br>";
    echo "Hora de fin: " . $tallerRescatado->getHoraFin()->format('H:i') . "<br>";
    echo "Cupo máximo: " . $tallerRescatado->getCupoMaximo() . "<br>";
}

echo "<h3>Borrando taller con ID $idTaller...</h3>";
$resultado = Taller::borrar($pdo, $idTaller);
if ($resultado == 0) {
    echo "No se ha borrado ningún taller con ID $idTaller";
} else if (!$resultado) {
    echo "Error al borrar el taller con ID $idTaller";
} else {
    echo "Taller con ID $idTaller borrado correctamente";
}

$idTaller = -1;
echo "<h3>Borrando taller con id $idTaller (no existe)...</h3>";
$resultado = Taller::borrar($pdo, $idTaller);
if ($resultado == 0) {
    echo "No se ha borrado ningún taller con ID $idTaller";
} else if (!$resultado) {
    echo "Error al borrar el taller con ID $idTaller";
} else {
    echo "Taller con ID $idTaller borrado correctamente";
}

/**********************************/
/***** PRUEBAS CLASE TALLERES *****/
/**********************************/
$talleres = Talleres::listar($pdo);
echo "<h1>Listado de talleres:</h1>";
foreach ($talleres as $taller) {
    echo "ID: " . $taller->getId() . "<br>";
    echo "Nombre: " . $taller->getNombre() . "<br>";
    echo "Descripción: " . $taller->getDescripcion() . "<br>";
    echo "Ubicación: " . $taller->getUbicacion() . "<br>";
    echo "Día de la semana: " . $taller->getDiaSemana() . "<br>";
    echo "Hora de inicio: " . $taller->getHoraInicio() . "<br>";
    echo "Hora de fin: " . $taller->getHoraFin() . "<br>";
    echo "Cupo máximo: " . $taller->getCupoMaximo() . "<br>";
    echo "<br>";
}
$talleresFiltrados = Talleres::filtrarPorDia($pdo, "Lunes");
echo "<h1>Listado de talleres filtrados por los Lunes:</h1>";
foreach ($talleresFiltrados as $taller) {
    echo "ID: " . $taller->getId() . "<br>";
    echo "Nombre: " . $taller->getNombre() . "<br>";
    echo "Descripción: " . $taller->getDescripcion() . "<br>";
    echo "Ubicación: " . $taller->getUbicacion() . "<br>";
    echo "Día de la semana: " . $taller->getDiaSemana() . "<br>";
    echo "Hora de inicio: " . $taller->getHoraInicio() . "<br>";
    echo "Hora de fin: " . $taller->getHoraFin() . "<br>";
    echo "Cupo máximo: " . $taller->getCupoMaximo() . "<br>";
    echo "<br>";
}

/**********************************/
/***** PRUEBAS CLASE PETICION *****/
/**********************************/
// Las pruebas de la clase Peticion no se realizan exhaustivamente, ya que se piden pruebas de clases que hemos creado nosotros mismos.
// Verificar que se reciben los datos por POST
$_POST = [
    "nombre" => "Taller peticion de prueba",
    "descripcion" => "Descripción peticion de prueba",
    "ubicacion" => "Ubicación peticion de prueba",
    "dia_semana" => "Lunes",
    "hora_inicio" => "08:00",
    "hora_fin" => "10:00",
    "cupo_maximo" => 8
];
$post = new Peticion(Peticion::POST);
echo "<h1>Datos recibidos vía POST:</h1>";
if ($post->has("nombre")) {
    echo "Nombre: " . $post->getString("nombre") . "<br>";
}
if ($post->has("descripcion")) {
    echo "Descripción: " . $post->getString("descripcion") . "<br>";
}
if ($post->has("ubicacion")) {
    echo "Ubicación: " . $post->getString("ubicacion") . "<br>";
}
if ($post->has("dia_semana")) {
    echo "Día de la semana: " . $post->getString("dia_semana") . "<br>";
}
if ($post->has("hora_inicio")) {
    echo "Hora de inicio: " . $post->getString("hora_inicio") . "<br>";
}
if ($post->has("hora_fin")) {
    echo "Hora de fin: " . $post->getString("hora_fin") . "<br>";
}
if ($post->has("cupo_maximo")) {
    echo "Cupo máximo: " . $post->getInt("cupo_maximo") . "<br>";
}