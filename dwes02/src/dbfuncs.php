<?php
function usuarios(PDO $pdo, bool $activos, string $filtro): array|int{
    
    $sql = "SELECT * FROM usuarios";
    if ($activos) {
        $sql .= " WHERE activo = 1";
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