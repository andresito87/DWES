<?php
function obtener_usuarios($PDO)
{

    $sql = 'SELECT * FROM usuarios;';

    $stmt = $PDO->prepare($sql);
    $resultado = false;
    try {
        if ($stmt->execute()) {
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    } catch (PDOException $e) {
        return false;
    }
}
