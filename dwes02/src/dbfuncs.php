<?php
/**
 * @description Funcion para obtener la lista de usuarios aplicando filtros
 * @file dbfuncs.php
 * @param PDO $pdo
 * @param bool $activos
 * @param string $filtro
 * @return array|int array con los usuarios o false si hay error
 * @author andres
 * @date 2023/11/18
 */
function usuarios(PDO $pdo, bool $activos, string $filtro): array|int
{
    $sql = "SELECT * FROM usuarios";
    if ($activos) {
        $sql .= " WHERE activo = 1";
    } else {
        $sql .= " WHERE activo = 0";
    }
    if ($filtro) {
        $sql .= " AND (nombre LIKE :filtro OR apellidos LIKE :filtro)";
    }
    $sql .= " ORDER BY ID";
    $stmt = $pdo->prepare($sql);
    if ($filtro) {
        $stmt->bindValue(':filtro', "%$filtro%", PDO::PARAM_STR);
    }
    $resultado = -1;
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
 * @param PDO $pdo
 * @param int $id
 * @return array|bool array con los detalles del usuario o false si hay error
 * @author andres
 * @date 2023/11/18
 */
function detallesUsuario(PDO $pdo, int $id): array|bool
{
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $resultado = -1;
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
 * @param PDO $pdo
 * @param string $DNI
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
    $resultado = -1;
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
 * @param PDO $pdo
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
    $resultado = -1;
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
 * @param PDO $pdo
 * @param string $fechahora
 * @param string $medioSeguimiento
 * @param string|null $otroMedioSeguimiento
 * @param string $contactadoSeguimiento
 * @param string|null $informeSeguimiento
 * @param int $empleadosId
 * @param int $usuariosId
 * @return bool|int false si hay error, 0 si no se ha insertado ningún registro o
 * el número de registros insertados si ha ido bien
 * @author andres
 * @date 2023/11/18
 */
function insertarSeguimientos(PDO $pdo, string $fechahora, string $medioSeguimiento, string|null $otroMedioSeguimiento, string $contactadoSeguimiento, string|null $informeSeguimiento, int $empleadosId, int $usuariosId): bool|int
{
    $sql = <<<ENDSQL
        INSERT INTO seguimiento (fechahora, medio, otro, contactado, informe, usuarios_id, empleados_id) 
        VALUES (:fechahora, :medio, :otro, :contactado, :informe, :usuarios_id, :empleados_id)
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':fechahora', $fechahora);
    $stmt->bindValue(':medio', $medioSeguimiento);
    $stmt->bindValue(':otro', $otroMedioSeguimiento);
    $stmt->bindValue(':contactado', $contactadoSeguimiento);
    $stmt->bindValue(':informe', $informeSeguimiento);
    $stmt->bindValue(':empleados_id', $empleadosId);
    $stmt->bindValue(':usuarios_id', $usuariosId);
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
 * @param PDO $pdo
 * @param int $idSeguimiento
 * @param string $informe
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
    $stmt->bindValue(':informe', $informe, PDO::PARAM_STR);
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
 * @param PDO $pdo
 * @param int $idSeguimiento
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
        if($stmt->execute()) {
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
        $stmt->bindValue(':id', $seguimiento['id']);
        $stmt->bindValue(':fechahora', $seguimiento['fechahora']);
        $stmt->bindValue(':medio', $seguimiento['medio']);
        $stmt->bindValue(':otro', $seguimiento['otro']);
        $stmt->bindValue(':contactado', $seguimiento['contactado']);
        $stmt->bindValue(':informe', $seguimiento['informe']);
        $stmt->bindValue(':empleados_id', $seguimiento['empleados_id']);
        $stmt->bindValue(':usuarios_id', $seguimiento['usuarios_id']);

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