<?php

function addRecordatorio(PDO $conn, $datos)
{
    $datosesperados=['recordar_hasta','titulo','detalle'];
    if (count(array_diff($datosesperados,array_keys($datos)))>0)
        {
            echo "Datos no esperados";
            return -1;
        } 
    try {
        $SQL = "INSERT INTO recordatorios (recordar_hasta, titulo, detalle) VALUES (:recordar_hasta,:titulo,:detalle)";
        $stmt = $conn->prepare($SQL);
        if ($stmt->execute($datos)) {
            return $stmt->rowCount();
        }
    } catch (PDOException $e) {
        var_dump($e);
    }
    return false;
}

function modRecordatorio(PDO $conn, $id, $datos)
{
    $datosesperados=['recordar_hasta','titulo','detalle'];
    if (count(array_diff($datosesperados,array_keys($datos)))>0)
        {
            echo "Datos no esperados";
            return -1;
        }         
    try {               
        $SQL = "UPDATE recordatorios SET recordar_hasta=:recordar_hasta, titulo=:titulo, detalle=:detalle WHERE id=:id AND recordar_hasta>now()";        
        $stmt = $conn->prepare($SQL);
        $stmt->bindValue(":recordar_hasta",$datos['recordar_hasta']);
        $stmt->bindValue(":titulo",$datos['titulo']);
        $stmt->bindValue(":detalle",$datos['detalle']);
        $stmt->bindValue(":id",$id);
        if ($stmt->execute()) {
            return $stmt->rowCount();
        }
    } catch (PDOException $e) {
        var_dump($e);
    }
    return false;
}

function delRecordatorio (PDO $conn, $id){
    try {               
        $SQL = "DELETE FROM recordatorios WHERE id=:id";        
        $stmt = $conn->prepare($SQL);
        $stmt->bindValue(":id",$id);
        if ($stmt->execute()) {
            return $stmt->rowCount();
        }
    } catch (PDOException $e) {
        var_dump($e);
    }
    return false;
}

function getRecordatorios (PDO $conn, $caducados=false){
    try {  
        $fragmentoSQL=$caducados?"recordar_hasta<now()":"recordar_hasta>=now()";
        $SQL = "SELECT id,recordar_hasta, titulo, detalle FROM recordatorios WHERE $fragmentoSQL";        
        $stmt=$conn->query($SQL);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);        
    } catch (PDOException $e) {
        var_dump($e);
    }
    return false;
}

function getRecordatorio (PDO $conn, $id){
    try {          
        $SQL = "SELECT id,recordar_hasta, titulo, detalle FROM recordatorios WHERE id=:id";              
        $stmt=$conn->prepare($SQL);
        $stmt->bindValue('id',$id,PDO::PARAM_INT);
        if ($stmt->execute())
        {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        var_dump($e);
    }
    return false;
}