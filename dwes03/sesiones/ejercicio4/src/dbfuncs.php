<?php
/**
 * @description Funcion para obtener la lista de usuarios aplicando filtros
 * @file dbfuncs.php
 * @param PDO $pdo Conexión a la base de datos
 * @param bool $activos true para obtener solo los usuarios activos, false para obtener solo los usuarios inactivos
 * @param string $filtro cadena de texto para filtrar por nombre y apellidos
 * @return array|int array con los usuarios o false si hay error
 * @author andres
 * @date 2023/11/18
 */
function usuarios(PDO $pdo, bool $activos, string $filtro): array|bool
{
    $sql = "SELECT * FROM usuarios";
    if ($activos) {
        $sql .= " WHERE activo = :activo";
    } else {
        $sql .= " WHERE activo = :activo";
    }
    if ($filtro) {
        $sql .= " AND CONCAT(nombre, ' ', apellidos) LIKE :filtro";
    }
    $sql .= " ORDER BY ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':activo', $activos, PDO::PARAM_BOOL);
    if ($filtro) {
        $stmt->bindValue(':filtro', "%$filtro%", PDO::PARAM_STR);
    }
    $resultado = false;
    try {
        if ($stmt->execute()) {
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        $resultado = false;
    }
    return $resultado;
}

/**
 * @description Funcion para obtener los detalles de un usuario
 * @file dbfuncs.php
 * @param PDO $pdo Conexión a la base de datos
 * @param int $id id del usuario
 * @return array|bool array con los detalles del usuario o false si hay error
 * @author andres
 * @date 2023/11/18
 */
function detallesUsuario(PDO $pdo, int $id): array|bool
{
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $resultado = false;
    try {
        if ($stmt->execute()) {
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        $resultado = false;
    }
    return $resultado;
}

/**
 * @description Funcion para obtener los seguimientos de un usuario
 * @file dbfuncs.php
 * @param PDO $pdo Conexión a la base de datos
 * @param string $DNI DNI del usuario
 * @return array|bool array con los seguimientos del usuario o false si hay error
 * @author andres
 * @date 2023/11/18
 */
function seguimientoUsuario(PDO $pdo, string $DNI): array|bool
{
    $sql = <<<ENDSQL
            SELECT empleados.nombre as nombre_empleado,
                   empleados.apellidos as apellidos_empleado,
                   seguimiento.id as id_seguimiento,
                   seguimiento.fechahora as fechahora_seguimiento,
                   seguimiento.medio as medio_seguimiento,
                   seguimiento.otro as otro_seguimiento,
                   seguimiento.contactado as contactado_seguimiento,
                   seguimiento.informe as informe_seguimiento,
                   usuarios.id as id_usuario,
                   usuarios.dni as dni_usuario
            FROM empleados 
                 JOIN seguimiento ON seguimiento.empleados_id=empleados.id 
                 JOIN usuarios ON seguimiento.usuarios_id=usuarios.id 
            WHERE usuarios.dni=:dni 
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':dni', $DNI, PDO::PARAM_STR);
    $resultado = false;
    try {
        if ($stmt->execute()) {
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        $resultado = false;
    }
    return $resultado;
}

/**
 * @description Funcion para obtener los empleados que son coordinadores o trabajadores sociales
 * @file dbfuncs.php
 * @param PDO $pdo Conexión a la base de datos
 * @return array|bool array con los empleados o false si hay error
 * @author andres
 * @date 2023/11/18
 */
function listadoCoordinadoresOTrabSociales(PDO $pdo): array|bool
{
    $sql = <<<ENDSQL
        SELECT * FROM empleados WHERE 
            find_in_set('coord',roles)>0 or
            find_in_set('trasoc',roles)>0
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        $resultado = false;
    }
    return $resultado;
}

/**
 * @description Funcion para insertar un seguimiento en la base de datos
 * @file dbfuncs.php
 * @param PDO $pdo Conexión a la base de datos
 * @param string $fechahora fecha y hora del seguimiento
 * @param string $medioSeguimiento medio de seguimiento
 * @param string|null $otroMedioSeguimiento otro medio de seguimiento
 * @param bool $contactadoSeguimiento si se ha contactado es true y sino false
 * @param string|null $informeSeguimiento informe del seguimiento
 * @param int $empleadosId id del empleado que va a realizar el seguimiento
 * @param int $usuariosId id del usuario al que se le va a realizar el seguimiento
 * @return bool|int false si hay error, 0 si no se ha insertado ningún registro o
 * el número de registros insertados si ha ido bien
 * @author andres
 * @date 2023/11/18
 */
function insertarSeguimientos(PDO $pdo, string $fechahora, string $medioSeguimiento, string|null $otroMedioSeguimiento, bool $contactadoSeguimiento, string|null $informeSeguimiento, int $empleadosId, int $usuariosId): bool|int
{
    $sql = <<<ENDSQL
        INSERT INTO seguimiento (fechahora, medio, otro, contactado, informe, usuarios_id, empleados_id) 
        VALUES (:fechahora, :medio, :otro, :contactado, :informe, :usuarios_id, :empleados_id)
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':fechahora', $fechahora);
    $stmt->bindValue(':medio', $medioSeguimiento);
    $stmt->bindValue(':contactado', $contactadoSeguimiento, PDO::PARAM_BOOL);
    $stmt->bindValue(':empleados_id', $empleadosId, PDO::PARAM_INT);
    $stmt->bindValue(':usuarios_id', $usuariosId, PDO::PARAM_INT);
    if ($otroMedioSeguimiento === null) {
        $stmt->bindValue(':otro', null, PDO::PARAM_NULL);
    } else {
        $stmt->bindValue(':otro', $otroMedioSeguimiento);
    }
    if ($informeSeguimiento === null) {
        $stmt->bindValue(':informe', null, PDO::PARAM_NULL);
    } else {
        $stmt->bindValue(':informe', $informeSeguimiento);
    }

    $resultado = 0;
    try {
        if ($stmt->execute()) {
            $resultado = $stmt->rowCount();
        }
    } catch (PDOException $e) {
        $resultado = false;
    }
    return $resultado;
}

/**
 * @description Funcion para actualizar el informe de un seguimiento
 * @file dbfuncs.php
 * @param PDO $pdo Conexión a la base de datos
 * @param int $idSeguimiento id del seguimiento
 * @param string $informe informe del seguimiento
 * @return bool|int false si hay error, 0 si no se ha actualizado ningún registro o
 * el número de registros actualizados si ha ido bien
 * @author andres
 * @date 2023/11/18
 */
function actualizarInforme(PDO $pdo, int $idSeguimiento, string $informe): bool|int
{
    $sql = <<<ENDSQL
        UPDATE seguimiento SET contactado = 1, informe = :informe WHERE id = :id;
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $idSeguimiento, PDO::PARAM_INT);
    $stmt->bindValue(':informe', $informe);
    $resultado = -1;
    try {
        if ($stmt->execute()) {
            $resultado = $stmt->rowCount();
        }
    } catch
    (PDOException $e) {
        $resultado = false;
    }
    return $resultado;
}

/**
 * @description Funcion para archivar un seguimiento, usando una transacción
 * @file dbfuncs.php
 * @param PDO $pdo Conexión a la base de datos
 * @param int $idSeguimiento id del seguimiento
 * @return bool|int -1 si se han suministrado datos incorrectos, false si hay error o true si ha ido bien
 * @author andres
 * @date 2023/11/18
 */
function archivarSeguimiento(PDO $pdo, int $idSeguimiento): bool|int
{
    $sql = <<<ENDSQL
        SELECT id, fechahora,medio, otro,contactado,informe,empleados_id,usuarios_id FROM seguimiento WHERE id=:id;
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $idSeguimiento, PDO::PARAM_INT);
    $pdo->beginTransaction();
    try {
        $seguimiento = [];
        if ($stmt->execute()) {
            $seguimiento = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$seguimiento) {
                $pdo->rollBack();
                return -1;
            } else if (empty($seguimiento)) {
                $pdo->rollBack();
                return -1;
            }
        }

        $sql = <<<ENDSQL
        INSERT INTO seguimiento_archivado (id, fechahora,medio, otro,contactado,informe,empleados_id,usuarios_id) 
        VALUES (:id, :fechahora, :medio, :otro, :contactado, :informe, :empleados_id, :usuarios_id);
    ENDSQL;
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $seguimiento['id'], PDO::PARAM_INT);
        $stmt->bindValue(':fechahora', $seguimiento['fechahora']);
        $stmt->bindValue(':medio', $seguimiento['medio']);
        $stmt->bindValue(':otro', $seguimiento['otro']);
        $stmt->bindValue(':contactado', $seguimiento['contactado'], PDO::PARAM_BOOL);
        $stmt->bindValue(':informe', $seguimiento['informe']);
        $stmt->bindValue(':empleados_id', $seguimiento['empleados_id'], PDO::PARAM_INT);
        $stmt->bindValue(':usuarios_id', $seguimiento['usuarios_id'], PDO::PARAM_INT);

        if (!$stmt->execute()) {
            $pdo->rollBack();
            return -1;
        } else if ($stmt->rowCount() === 0) {
            $pdo->rollBack();
            return -1;
        }

        $sql = <<<ENDSQL
        DELETE FROM seguimiento WHERE id=:id;
    ENDSQL;
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $idSeguimiento, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            $pdo->rollBack();
            return -1;
        } else if ($stmt->rowCount() === 0) {
            $pdo->rollBack();
            return -1;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();
        return false;
    }
    $pdo->commit();
    return true;
}