<?php
function obtener_recordatorio($PDO, $id)
{
    $sql = 'SELECT * FROM recordatorios WHERE id=:id';

    $stmt = $PDO->prepare($sql);
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

function obtener_recordatorios($PDO, $caducados = false)
{
    $fragmento_SQL = $caducados ? "recordar_hasta<now()" : "recordar_hasta>=now()";
    $sql = "SELECT * FROM recordatorios WHERE $fragmento_SQL;";

    $stmt = $PDO->prepare($sql);
    $resultado = false;
    try {
        if ($stmt->execute()) {
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
    }
    return $resultado;
}


function eliminar_recordatorio($PDO, $id)
{
    $sql = 'DELETE FROM recordatorios WHERE id=:id;';

    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    $resultado = false;
    try {
        if ($stmt->execute()) {
            $resultado = $stmt->rowCount();
        }
    } catch (PDOException $e) {
    }

    return $resultado;
}

function agregar_recordatorio($PDO, $recordatorio)
{
    $sql = 'INSERT INTO recordatorios (recordar_hasta,titulo,detalle) 
        VALUES (:recordar_hasta, :titulo, :detalle)';

    $stmt = $PDO->prepare($sql);
    $stmt->bindValue(':recordar_hasta', $recordatorio['recordar_hasta']);
    $stmt->bindValue(':titulo', $recordatorio['titulo']);
    $stmt->bindValue(':detalle', $recordatorio['detalle']);

    $resultado = false;
    try {
        if ($stmt->execute()) {
            $resultado = $stmt->rowCount();
        }
    } catch (PDOException $e) {
    }
    return $resultado;
}

function actualizar_recordatorio($PDO, $id, $recordatorio)
{
    try {
        $sql = 'UPDATE recordatorios SET recordar_hasta = :recordar_hasta, titulo = :titulo, detalle = :detalle WHERE id = :id';

        $stmt = $PDO->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':recordar_hasta', $recordatorio['recordar_hasta']);
        $stmt->bindValue(':titulo', $recordatorio['titulo']);
        $stmt->bindValue(':detalle', $recordatorio['detalle']);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}
