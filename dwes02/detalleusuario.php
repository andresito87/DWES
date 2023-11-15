<?php
require_once 'src/conn.php';
require_once 'src/dbfuncs.php';

if (isset($_POST['idDetalleUsuario'])) {
    $pdo = connect();
    $id = filter_input(INPUT_POST, 'idDetalleUsuario', FILTER_VALIDATE_INT);

    try {
        $usuario = detallesUsuario($pdo, $id);
        if (!$usuario) {
            die("<p>No se ha encontrado el usuario</p>");
        }
    } catch (PDOException $e) {
        $error = $e->getMessage();
        die("Error:. $error");
    }
}

?>

<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/estilosDetalleUsuario.css">
    <title>Detalles de Usuario</title>
</head>
<body>
<h1>Detalles de Usuario</h1>
<table class="detallesUsuario">
    <?php
    echo "<tr>";
    echo "<td>Identificador de usuario:</td>";
    echo "<td>" . ($usuario['id'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>DNI:</td>";
    echo "<td>" . ($usuario['dni'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Fecha de Nacimiento:</td>";
    echo "<td>" . ($usuario['fnacim'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Nombre:</td>";
    echo "<td>" . ($usuario['nombre'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Apellidos:</td>";
    echo "<td>" . ($usuario['apellidos'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Teléfono:</td>";
    echo "<td>" . ($usuario['telefono'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Email personal del usuario:</td>";
    echo "<td>" . ($usuario['email'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Nombre del tutor o tutora legal:</td>";
    echo "<td>" . ($usuario['nombre_tutor'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Apellidos del tutor o tutora legal:</td>";
    echo "<td>" . ($usuario['apellidos_tutor'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Teléfono del tutor o tutora legal:</td>";
    echo "<td>" . ($usuario['telefono_tutor'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Email del tutor o tutora legal:</td>";
    echo "<td>" . ($usuario['email_tutor'] ?? '<span>Dato no registrado</span>') . "</td>";
    echo "</tr>";
    ?>
</table>

<h1>Tabla de Seguimientos</h1>

<table class="seguimientos">
    <thead>
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
    </thead>
    <tbody>
    <?php
    if (isset($usuario['dni'])) {
        try {
            $seguimientos = seguimientoUsuario($pdo, $usuario['dni']);
        } catch (PDOException $e) {
            $error = $e->getMessage();
            die("Error:. $error");
        }
    }
    if (empty($seguimientos)) {
        echo "<tr>";
        echo "<td class='sinRegistros' colspan='8'>No hay seguimientos para este usuario</td>";
        echo "</tr>";
    } else {
        foreach (seguimientoUsuario($pdo, $usuario['dni']) as $seguimiento) {
            echo "<tr>";
            echo "<td>" . $seguimiento['nombre_empleado'] . "</td>";
            echo "<td>" . $seguimiento['apellidos_empleado'] . "</td>";
            echo "<td>" . $seguimiento['id_seguimiento'] . "</td>";
            echo "<td>" . $seguimiento['fechahora_seguimiento'] . "</td>";
            echo "<td>" . $seguimiento['medio_seguimiento'] . "</td>";
            echo "<td>" . $seguimiento['contactado_seguimiento'] . "</td>";
            echo "<td>" . $seguimiento['informe_seguimiento'] . "</td>";
            echo "<td>";
            echo "<form action='archivarseguimiento.php' method='post'>";
            echo "<input type='hidden' name='idUsuario' value='" . $usuario['id'] . "'>";
            echo "<input type='hidden' name='idSeguimiento' value='" . $seguimiento['id_seguimiento'] . "'>";
            echo "<input type='submit' class='botonSeguimiento' value='Archivar seguimiento'>";
            echo "</form>";
            if (!$seguimiento["contactado_seguimiento"]) {
                echo "<form action='seguimientocontactado.php' method='post'>";
                echo "<input type='hidden' name='idUsuario' value='" . $usuario['id'] . "'>";
                echo "<input type='hidden' name='idSeguimiento' value='" . $seguimiento['id_seguimiento'] . "'>";
                echo "<input type='submit' class='botonContactado' value='Contactado'>";
                echo "</form>";
            }
            echo "</td>";
            echo "</tr>";
        }
    }
    ?>
    </tbody>
</table>

<h1>Crear nuevo seguimiento</h1>
<form class="nuevoSeguimiento" action="registrarseguimiento.php" method="post">
    <label for="fechaSeguimiento">Fecha</label>
    <input type="text" name="fechaSeguimiento" id="fechaSeguimiento">(formato dd/mm/aaaa)</input>
    <br>
    <label for="horaSeguimiento">Hora</label>
    <input type="text" name="horaSeguimiento" id="horaSeguimiento">(formato hh:mm)</input>
    <br>
    <label for="empleadoSeguimiento">Empleado</label>
    <select name="empleadoSeguimiento" id="empleadoSeguimiento">
        <?php
        $empleados = listadoCoordinadoresOTrabSociales($pdo);
        if (empty($empleados)) {
            die("<p>No hay empleados disponibles</p>");
        } else {
            foreach ($empleados as $empleado) {
                echo "<option value='" . $empleado['id'] . "'>" . $empleado['nombre'] . " " . $empleado['apellidos'] . "</option>";
            }
        }

        $pdo = null;
        ?>
    </select>
    <br>
    <label for="medioSeguimiento">Medio de contacto</label>
    <select name="medioSeguimiento" id="medioSeguimiento">
        <option value="TLF">Teléfono</option>
        <option value="EMAIL">Email</option>
        <option value="PRESENCIAL">Presencial</option>
        <option value="VIDEOCONF">Videoconferencia</option>
        <option value="OTRO">Otro</option>
    </select>
    <br>
    <label for="otroMedioSeguimiento">Otro medio de contacto</label>
    <input type="text" name="otroMedioSeguimiento" id="otroMedioSeguimiento">
    <br>
    <input type="hidden" value="<?php echo $usuario['id'] ?>" name="idUsuario">
    <input type="submit" value="Registrar seguimiento">
</form>
</body>
</html>
