<?php

//TAREA 3: +++ Incluir control sesion
require_once __DIR__ . '/session_control.php';
//TAREA 3: --- FIN Incluir control sesion

require_once __DIR__ . '/etc/conf.php';
require_once __DIR__ . '/src/conn.php';
require_once __DIR__ . '/src/dbfuncs.php';

//TAREA 3: +++ Incluir funciones control usuarios
require_once __DIR__ . '/src/userauth.php';
//TAREA 3: --- FIN Incluir funciones control usuarios


//TAREA 3: +++ Control de rol (SOLO COORDINADOR, TRABAJADOR SOCIAL y ADMIN)
if (!(tieneRol(ROL_ADMIN) || tieneRol(ROL_COORD) || tieneRol(ROL_TRASOC))) {
    header('Location: usuarios.php');
    exit;
}
//TAREA 3: --- FIN CONTROL DE ROL

$idusuario = filter_input(INPUT_POST, 'idusuario', FILTER_VALIDATE_INT);

//TAREA 3: +++ Almacenamiento de ID USUARIO último VISTO 
if ($idusuario!==null && $idusuario!==false)
{
    $_SESSION['form_detalle_usuario']['idusuario']=$idusuario;
}
elseif (isset($_SESSION['form_detalle_usuario']['idusuario']))
{
    $idusuario=$_SESSION['form_detalle_usuario']['idusuario'];
}
//TAREA 3: --- FIN Almacenamiento de ID USUARIO último VISTO 

$pdo = connect();
$detalle_usuario = detalle($pdo, id: $idusuario);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del usuario</title>
    <link rel="stylesheet" href="styles/dwes02.css">
</head>

<body>
    <?php
    //TAREA 3: +++ Incluir header.php
    include 'extra/header.php';
    //TAREA 3: --- Incluir header.php
    ?>
    <h1>Detalle del Usuario</h1>
    <?php if (is_array($detalle_usuario) && count($detalle_usuario) > 0) :   ?>
        <table>
            <?php
            $dataDesc = array(
                'id' => 'Identificador de usuario',
                'dni' => 'DNI o NIE',
                'fnacim' => 'Fecha de nacimiento',
                'nombre' => 'Nombre',
                'apellidos' => 'Apellidos',
                'telefono' => 'Teléfono personal del usuario',
                'email' => 'Email personal del usuario',
                'nombre_tutor' => 'Nombre del tutor o tutora legal',
                'apellidos_tutor' => 'Apellidos del tutor o tutora legal',
                'telefono_tutor' => 'Teléfono del tutor o tutora legal',
                'email_tutor' => 'Email del tutor o tutora legal'
            );

            foreach ($detalle_usuario as $key => $value) {
                echo "<tr>";
                echo "<th style=\"width:300px\">{$dataDesc[$key]}</th>";
                echo "<td>" . ($value ? $value : "<i>Dato no registrado</i>") . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <?php 
        //TAREA 3: +++ No mostrar seguimientos si no se tiene el rol de coordinador o trabajador social
        if (tieneRol(ROL_COORD) || tieneRol(ROL_TRASOC)): 
        //TAREA 3: --- FIN No mostrar seguimientos si no se tiene el rol de coordinador o trabajador social
        ?>
            <?php
            if ($detalle_usuario) {
                $seguimientos = listarSeguimientos($pdo, $detalle_usuario['dni']);
            }
            if (isset($seguimientos) && is_array($seguimientos) && count($seguimientos) > 0) :?>
                <h1>Tabla de Seguimientos</h1>
                <table>
                    <tr>
                        <th>Nombre del Empleado</th>
                        <th>Apellidos del Empleado</th>
                        <th>ID de Seguimiento</th>
                        <th>Fecha y Hora del Seguimiento</th>
                        <th>Medio de Seguimiento</th>
                        <th>Contactado</th>
                        <th>Informe de Seguimiento</th>
                        <th>Acciones</th>
                    </tr>
                    <?php foreach ($seguimientos as $seguimiento) : ?>
                        <tr>
                            <td><?= $seguimiento['nombre_empleado'] ?></td>
                            <td><?= $seguimiento['apellidos_empleado'] ?></td>
                            <td><?= $seguimiento['id_seguimiento'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($seguimiento['fechahora_seguimiento'])) ?></td>
                            <td>
                                <?php if ($seguimiento['medio_seguimiento'] === 'OTRO') : ?>
                                    OTRO (<?= htmlspecialchars($seguimiento['otro_seguimiento']) ?>)
                                <?php else : ?>
                                    <?= $seguimiento['medio_seguimiento'] ?>
                                <?php endif; ?>
                            </td>
                            </td>
                            <td><?= $seguimiento['contactado_seguimiento'] == 1 ? 'Sí' : 'No' ?></td>
                            <td><?= $seguimiento['informe_seguimiento'] ?></td>
                            <td>
                                <form action="archivarseguimiento.php" method="post">
                                    <input type="submit" value="Archivar seguimiento">
                                    <input type="hidden" name="idseguimiento" value="<?= $seguimiento['id_seguimiento'] ?>">
                                    <input type="hidden" name="idusuario" value="<?= $detalle_usuario['id'] ?>">
                                </form>
                                <?php if (!$seguimiento['contactado_seguimiento']) : ?>
                                    <BR>
                                    <form action="seguimientocontactado.php" method="post">
                                        <input type="submit" value="Contactado">
                                        <input type="hidden" name="id_seguimiento" value="<?= $seguimiento['id_seguimiento'] ?>">
                                        <input type="hidden" name="idusuario" value="<?= $detalle_usuario['id'] ?>">
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else : ?>
                <h2>No se han registrado seguimientos para el usuario.</h2>
            <?php endif; ?>
            <?php

            //TAREA 3: +++ Solo mostrar la lista de empleados TRASOC y COORD cuando es ROL_COORD
            if (tieneRol(ROL_COORD))
                $empleados = listarEmpleadosSeguimiento($pdo);            
            //TAREA 3: --- Solo mostrar la lista de empleados TRASOC y COORD cuando es ROL_COORD
            
            include('extra/formseguimiento.php');
            ?>
        <?php endif; ?>
    <?php else : ?>
        <h2>No se ha encontrado el usuario o no se ha proporcionado un id de usuario.</h2>
        <A href="usuarios.php">Volver a lista de usuarios.</A>
    <?php endif; ?>
</body>

</html>