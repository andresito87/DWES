<?php
function usuarios(PDO $pdo, bool $activos, string $filtro): array|int
{

    $sql = "SELECT * FROM usuarios";
    if ($activos) {
        $sql .= " WHERE activo = 1";
    } else {
        $sql .= " WHERE activo = 0";
    }
    if ($filtro) {
        $sql .= " AND nombre LIKE :filtro";
    }
    $sql .= " ORDER BY ID";
    $stmt = $pdo->prepare($sql);
    if ($filtro) {
        $stmt->bindValue(':filtro', "%$filtro%");
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function detallesUsuario(PDO $pdo, int $id): array
{
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
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
    $stmt->bindValue(':dni', $DNI);
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
        UPDATE seguimiento SET contactado = 0, informe = :informe WHERE id = :id;
    ENDSQL;
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $idSeguimiento);
    $stmt->bindValue(':informe', $informe);
    $stmt->execute();
    return $stmt->rowCount() === 1;
}