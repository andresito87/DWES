<?php

namespace DWES04\controllers;

use PDO;
use DateTime;
use DWES04\DB;
use Smarty\Smarty;
use DWES04\models\Taller;
use DWES04\models\Talleres;
use DWES04\models\Peticion;

/**
 * Clase Controladores implementando el patrón MVC.
 * 
 * Esta clase implementa el patrón MVC, en ella se encuentran los métodos que se encargan de gestionar las peticiones
 * que recibe la aplicación, de llamar a los métodos de los modelos necesarios para realizar las operaciones
 * correspondientes y de mostrar las vistas necesarias. Recoje toda la lógica de la aplicación. Los nombres de los métodos
 * de esta clase coinciden con el nombre de las acciones que se pueden realizar en la aplicación.
 * 
 * @package DWES04\controllers
 * @author Andrés Samuel Podadera González
 * @uses DB DWES04\DB
 * @uses Taller DWES04\models\Taller
 * @uses Talleres DWES04\models\Talleres
 * @uses Peticion DWES04\models\Peticion
 * @uses PDO https://www.php.net/manual/es/class.pdo.php
 * @uses Smarty https://www.smarty.net/
 * @uses DateTime https://www.php.net/manual/es/class.datetime.php   
 * @version 1.0
 */
class Controladores
{
    /**
     * Método controlador por defecto. Si el usuario no ha realizado ninguna petición, se ejecuta este método.
     * 
     * Este método se encarga de mostrar el listado de talleres y de filtrar los talleres por día de la semana. 
     * Si se recibe un día de la semana por POST, se filtran los talleres por ese día y se muestran los talleres
     * correspondientes. Si no se recibe un día de la semana por POST, se muestran todos los talleres.
     * 
     * @param PDO $pdo Conexión a la base de datos.
     * @param Smarty $smarty Objeto de la clase Smarty que se encarga de mostrar las vistas.
     * @param Peticion $peticion Objeto de la clase Peticion que se encarga de gestionar las peticiones recibidas.
     * 
     * @return void No retorna nada.
     */
    public static function accionPorDefecto(PDO $pdo, Smarty $smarty, Peticion $peticion): void
    {
        // Verificar si se recibieron datos por POST y que se haya seleccionado un día de la semana
        if ($peticion->isPost() && $peticion->has('dia_semana')) {
            // Verificar que el valor de 'diaSemana' sea válido
            if (in_array($diaSemana = strtolower($peticion->getString('dia_semana')), ['lunes', 'martes', 'miércoles', 'jueves', 'viernes'])) {
                $talleres = Talleres::filtrarPorDia($pdo, $diaSemana);
                if (is_array($talleres) && !empty($talleres)) {
                    $smarty->display('formularioFiltrarDia.tpl');
                    $smarty->assign('talleres', $talleres);
                    $smarty->display('mostrarTalleres.tpl');
                } else {
                    $smarty->assign('errores', 'No se encontraron talleres para el día seleccionado');
                    $smarty->display('mostrarErrores.tpl');
                    $smarty->display('formularioFiltrarDia.tpl');
                    $talleres = Talleres::listar($pdo);
                    $smarty->assign('talleres', $talleres);
                    $smarty->display('mostrarTalleres.tpl');
                }
            } else { // El valor de 'diaSemana' no es válido
                $smarty->assign('errores', 'El día de la semana no es válido');
                $smarty->display('mostrarErrores.tpl');
                $smarty->display('formularioFiltrarDia.tpl');
                $talleres = Talleres::listar($pdo);
                $smarty->assign('talleres', $talleres);
                $smarty->display('mostrarTalleres.tpl');
            }
        } else {
            // No se recibieron datos por POST o no viene el parámetro 'diaSemana'
            $talleres = Talleres::listar($pdo);
            if (is_array($talleres)) {
                $smarty->assign('talleres', $talleres);
                $smarty->display('formularioFiltrarDia.tpl');
                $smarty->display('mostrarTalleres.tpl');
            } else {
                // Mostrar mensaje de error
                $smarty->assign('errores', 'No se pudieron recuperar los talleres');
                $smarty->display('mostrarErrores.tpl');
            }
        }
        // Cerrar la conexión a la base de datos
        DB::cerrarConexion();
        $smarty->display('enlaceFormularioNuevoTaller.tpl');
    }

    /**
     * Método controlador para mostrar el formulario de creación de un nuevo taller.
     * 
     * Este método se encarga de mostrar el formulario de creación de un nuevo taller.
     * 
     * @param Smarty $smarty Objeto de la clase Smarty que se encarga de mostrar las vistas.
     * 
     * @return void No retorna nada.
     */
    public static function nuevoTallerForm(Smarty $smarty): void
    {
        // Obtener el día de la semana como un número (1 para lunes, 2 para martes, ..., 7 para domingo)
        $numero_dia_actual = date('N');

        // Array con los nombres de los días de la semana
        $dias_semana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        // Obtener el nombre del día actual en minúsculas utilizando el número obtenido anteriormente
        // Restamos 1 porque los días de la semana empiezan en 1 y nuestro array de días de la semana empieza en 0
        $dia_actual = $dias_semana[$numero_dia_actual - 1];

        // Asignar el nombre del día actual a Smarty
        $smarty->assign('dia_actual', $dia_actual);

        // Asignar array de días de la semana a Smarty
        $dias_validos = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        $smarty->assign('dias_validos', $dias_validos);

        // Cargar la plantilla Smarty
        $smarty->display('formularioNuevoTaller.tpl');
    }

    /**
     * Método controlador para crear un nuevo taller.
     * 
     * Este método se encarga de crear un nuevo taller a partir de los datos recibidos por POST y si no hay errores
     * en los datos recibidos, se guarda el taller en la base de datos y se muestra un mensaje de éxito. Si hay errores
     * en los datos recibidos, se muestran los errores.
     * 
     * @param PDO $pdo Conexión a la base de datos.
     * @param Smarty $smarty Objeto de la clase Smarty que se encarga de mostrar las vistas.
     * @param Peticion $peticion Objeto de la clase Peticion que se encarga de gestionar las peticiones recibidas.
     * 
     * @return void No retorna nada.
     */
    public static function nuevoTaller(PDO $pdo, Smarty $smarty, Peticion $peticion)
    {
        $errores = [];
        if ($peticion->has('nombre')) {
            $nombre = $peticion->getString('nombre');
        } else {
            $errores[] = 'El nombre del taller es obligatorio';
        }

        if ($peticion->has('descripcion')) {
            $descripcion = $peticion->getString('descripcion');
        } else {
            $errores[] = 'La descripción del taller es obligatoria';
        }

        if ($peticion->has('ubicacion')) {
            $ubicacion = $peticion->getString('ubicacion');
        } else {
            $errores[] = 'La ubicación del taller es obligatoria';
        }

        if ($peticion->has('dia_semana')) {
            $dia_semana = strtolower($peticion->getString('dia_semana'));
            // Poner en mayusculas la primera letra del día de la semana
            $dia_semana = ucfirst($dia_semana);
        } else {
            $errores[] = 'El día de la semana es obligatorio';
        }

        if ($peticion->has('hora_inicio')) {
            $hora_inicio = $peticion->getString('hora_inicio');
            $hora_inicio = DateTime::createFromFormat('H:i', $hora_inicio);
        } else {
            $errores[] = 'La hora de inicio es obligatoria';
        }

        if ($peticion->has('hora_fin')) {
            $hora_fin = $peticion->getString('hora_fin');
            $hora_fin = DateTime::createFromFormat('H:i', $hora_fin);
        } else {
            $errores[] = 'La hora de fin es obligatoria';
        }

        if ($peticion->has('cupo_maximo')) {
            $cupo_maximo = $peticion->getInt('cupo_maximo');
        } else {
            $errores[] = 'El cupo máximo es obligatorio';
        }

        $taller = new Taller();
        if (!$taller->setNombre($nombre)) {
            $errores[] = 'El nombre del taller no es válido';
        }
        if (!$taller->setDescripcion($descripcion)) {
            $errores[] = 'La descripción del taller no es válida';
        }
        if (!$taller->setUbicacion($ubicacion)) {
            $errores[] = 'La ubicación del taller no es válida';
        }
        if (!$taller->setDiaSemana($dia_semana)) {
            $errores[] = 'El día de la semana no es válido';
        }
        if (!$taller->setHoraInicio($hora_inicio)) {
            $errores[] = 'La hora de inicio no es válida';
        }
        if (!$taller->setHoraFin($hora_fin)) {
            $errores[] = 'La hora de fin no es válida';
        }
        if (!$taller->setCupoMaximo($cupo_maximo)) {
            $errores[] = 'El cupo máximo no es válido';
        }

        if (empty($errores)) {
            if ($taller->guardar($pdo)) {
                $smarty->assign('id', $taller->getId());
                $smarty->display('mensajeCreacionConExito.tpl');
            } else {
                $smarty->assign('errores', 'No se pudo crear el taller');
                $smarty->display('mostrarErrores.tpl');
            }
        } else {
            $smarty->assign('errores', $errores);
            $smarty->display('mostrarErrores.tpl');
        }
        // Cerrar la conexión a la base de datos
        DB::cerrarConexion();
        $smarty->display('enlaceVolverAListadoTalleres.tpl');
    }

    /**
     * Método controlador que permite borrar un taller de la base de datos.
     * 
     * Este método se encarga de borrar un taller de la base de datos. Si se recibe un id por POST, se muestra un
     * formulario de confirmación para borrar el taller. Si se recibe un id y se confirma la eliminación, se borra el
     * taller de la base de datos y se muestra un mensaje de éxito. Si no se recibe un id por POST, se muestra un
     * mensaje de error.
     * 
     * @param PDO $pdo Conexión a la base de datos.
     * @param Smarty $smarty Objeto de la clase Smarty que se encarga de mostrar las vistas.
     * @param Peticion $peticion Objeto de la clase Peticion que se encarga de gestionar las peticiones recibidas.
     * 
     * @return void No retorna nada.
     */
    public static function borrarTaller(PDO $pdo, Smarty $smarty, Peticion $peticion)
    {
        // Verificar si se recibió un id por POST y si se confirmó la eliminación
        if ($peticion->has('id') && $peticion->has('eliminar') && $peticion->getString('eliminar') == "eliminar") {
            $id = $peticion->getInt('id');
            if (Taller::borrar($pdo, $id)) {
                $smarty->assign('id', $id);
                $smarty->display('mensajeEliminacionConExito.tpl');
                $smarty->display('enlaceVolverAListadoTalleres.tpl');
            } else {
                $smarty->assign('errores', 'No se pudo borrar el taller, ese taller no existe o ya fue borrado');
                $smarty->display('mostrarErrores.tpl');
            }
        } else if ($peticion->has('id')) { // Verificar si se recibió un id por POST, para mostrar el formulario de confirmación
            $id = $peticion->getInt('id');
            $smarty->assign('id', $id);
            $smarty->display('formularioConfirmarEliminacion.tpl');
        } else { // No se recibió un id por POST
            $smarty->assign('errores', 'No se pudo borrar el taller, error en el id recibido');
            $smarty->display('mostrarErrores.tpl');
        }
        // Cerrar la conexión a la base de datos
        DB::cerrarConexion();
    }
}