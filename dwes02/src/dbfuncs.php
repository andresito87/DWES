<?php
function usuarios(PDO $pdo, bool $activos, string $filtro): array
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
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function detallesUsuario(PDO $pdo, int $id): array|bool
{
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function seguimientoUsuario(PDO $pdo, string $DNI): array
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
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function listadoCoordinadoresOTrabSociales(PDO $pdo): array
{
    $sql = <<<ENDSQL
        SELECT * FROM empleados WHERE 
            find_in_set('coord',roles)>0 or
            find_in_set('trasoc',roles)>0
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertarSeguimientos(PDO $pdo, string $fechahora, string $medioSeguimiento, string|null $otroMedioSeguimiento, string $contactadoSeguimiento, string|null $informeSeguimiento, int $empleadosId, int $usuariosId): bool
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
    $stmt->execute();
    return $stmt->rowCount() === 1;
}

function actualizarInforme(PDO $pdo, int $idSeguimiento, string $informe): bool
{
    $sql = <<<ENDSQL
        UPDATE seguimiento SET contactado = 1, informe = :informe WHERE id = :id;
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $idSeguimiento, PDO::PARAM_INT);
    $stmt->bindValue(':informe', $informe, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount() === 1;
}

function archivarSeguimiento(PDO $pdo, int $idSeguimiento): bool
{
    $pdo->beginTransaction();
    $sql = <<<ENDSQL
        SELECT id, fechahora,medio, otro,contactado,informe,empleados_id,usuarios_id FROM seguimiento WHERE id=:id;
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $idSeguimiento, PDO::PARAM_INT);
    $stmt->execute();
    $seguimiento = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$seguimiento) {
        $pdo->rollBack();
        return false;
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
    $stmt->execute();
    if ($stmt->rowCount() !== 1) {
        $pdo->rollBack();
        return false;
    }
    $sql = <<<ENDSQL
        DELETE FROM seguimiento WHERE id=:id;
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $idSeguimiento, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() !== 1) {
        $pdo->rollBack();
        return false;
    }
    $pdo->commit();
    return true;
}