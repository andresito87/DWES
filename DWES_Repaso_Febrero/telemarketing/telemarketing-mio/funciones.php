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

function guardar_usuario($PDO, $usuario)
{
    $sql = 'INSERT INTO usuarios (nombre,telefono) VALUES (:nombre, :telefono);';

    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':nombre', $usuario['nombre']);
    $stmt->bindValue(':telefono', $usuario['telefono']);

    $resultado = false;
    try {
        if ($stmt->execute()) {
            $resultado = $stmt->rowCount();
        }
    } catch (PDOException $e) {
    }
    return $resultado;
}
