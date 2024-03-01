<?php

namespace DWES04\models;

use PDO;
use PDOException;
use DWES04\models\Taller;

/**
 * Clase que gestiona los talleres.
 * 
 * Permite listar todos los talleres almacenados en la base de datos yfiltrarlos por día de la semana.
 * De Lunes a Viernes.
 * 
 * @package DWES04\models
 * @author Andrés Samuel Podadera González
 * @uses Taller DWES04\models\Taller
 * @uses PDO https://www.php.net/manual/es/class.pdo.php
 * @uses PDOException https://www.php.net/manual/es/class.pdoexception.php
 * @version 1.0
 */
class Talleres
{
    /**
     * Lista todos los talleres almacenados en la base de datos.
     * 
     * Permite listar todos los talleres almacenados en la base de datos,
     * recuperando todos los campos de la tabla talleres.
     * 
     * @param PDO $con Conexión a la base de datos.
     * 
     * @return array|bool|int Retorna un array con los talleres almacenados en la base de datos, 
     * -1 si no se pudo ejecutar la consulta o false si se produjo una excepción en la operación.
     */
    public static function listar(PDO $con): array|bool|int
    {
        try {
            $sql = "SELECT id, nombre, descripcion, ubicacion, dia_semana, hora_inicio, hora_fin, cupo_maximo FROM talleres";
            $stmt = $con->prepare($sql);
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_CLASS, Taller::class);
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            return false;
        }
    }

    /**
     * Filtra los talleres por día de la semana.
     * 
     * Permite filtrar los talleres almacenados en la base de datos por día de la semana.
     * 
     * @param PDO $con Conexión a la base de datos.
     * @param string $diaSemana Día de la semana por el que se quiere filtrar.
     * 
     * @return array|bool|int Retorna un array con los talleres almacenados en la base de datos, 
     * -1 si no se pudo ejecutar la consulta o false si se produjo una excepción en la operación.
     */
    public static function filtrarPorDia(PDO $con, string $diaSemana): array|bool|int
    {
        try {
            $sql = "SELECT * FROM talleres WHERE dia_semana=:dia";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':dia', $diaSemana);
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_CLASS, Taller::class);
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            return false;
        }
    }
}