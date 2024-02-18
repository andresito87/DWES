<?php

namespace DWES04;

require_once __DIR__ . '/../conf/conf.php';

use PDO;
use DWES04\exceptions\AppException;
use PDOException;

/**
 * Clase que gestiona la conexión a la base de datos.
 * 
 * Permite gestionar la conexión a la base de datos y ejecutar consultas SQL.
 * 
 * @package DWES04
 * @author Profesor
 * @uses PDO https://www.php.net/manual/es/class.pdo.php
 * @uses AppException DWES04\exceptions\AppException
 * @uses PDOException https://www.php.net/manual/es/class.pdoexception.php
 * @version 1.0
 */
class DB
{
    /**
     * Conexión a la base de datos.
     * @var PDO|null Conexión a la base de datos.
     * @static
     * @access private
     * @see obtenerConexion
     */
    private static $conn = null;

    /**
     * Método que obtiene la conexión a la base de datos.
     * 
     * Permite obtener la conexión a la base de datos.
     * 
     * @return PDO Conexión a la base de datos.
     * 
     * @throws AppException Si no se puede conectar a la base de datos.
     */
    public static function obtenerConexion()
    {
        if (!(static::$conn instanceof PDO)) {
            try {
                static::$conn = new PDO(
                    DB_DSN,
                    DB_USER,
                    DB_PASSWORD,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                );
            } catch (PDOException $e) {
                static::$conn = false;
                throw new AppException
                (
                    'Error DB. No se puede continuar. Revisa el valor de las constantes DB_USER y DB_PASSWORD en el archivo /conf/conf.php.',
                    AppException::DB_UNABLE_TO_CONNECT
                );
            }
        }
        return static::$conn;
    }

    /**
     * Método que cierra la conexión a la base de datos.
     * 
     * Permite cerrar la conexión a la base de datos.
     * 
     * @return void
     * 
     * @see obtenerConexion
     */
    public static function cerrarConexion()
    {
        static::$conn = null;
    }

    /**
     * Método que ejecuta una consulta SQL inyectandole datos opcionales.
     * @param $sql consulta SQL conforme a PDO Prepared Statement.
     * @param $data array asociativo con los datos a reemplazar en la consulta (conforme a PDO Prepared Statement)
     * @return  array|bool|int Si la consulta es tipo SELECT se obtendrá un array asociativo con los resultados.
     * Si la consulta es tipo INSERT/UPDATE/DELETE se obtendrá el número de registros afectados.    
     * @throws AppException Si algo en la consulta va mal eleva una excepción tipo AppException con
     * uno de los códigos disponibles en función del problema producido.
     */
    public static function doSQL($sql, $data = [])
    {
        $ret = false;
        $pdo = self::obtenerConexion();
        if (!$pdo)
            throw new AppException(
                'Error DB: no se puede conectar con la base de datos',
                AppException::DB_NOT_CONNECTED
            );
        try {
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute($data)) {
                if (preg_match('/^\s*SELECT\s/i', $sql))
                    $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
                else
                    $ret = $stmt->rowCount();
            } else
                throw new AppException(
                    'Error DB: Fallo al ejecutar la consulta SQL.',
                    AppException::DB_QUERY_EXECUTION_FAILURE
                );
        } catch (PDOException $ex) {
            if ($ex->getCode() === '23000') {
                throw new AppException(
                    'Error DB: la consulta realizada incumple las restricciones de la base de datos.',
                    AppException::DB_CONSTRAINT_VIOLATION_IN_QUERY
                );
            }
            throw new AppException(
                'Error DB: error en la consulta.',
                AppException::DB_ERROR_IN_QUERY
            );
        }
        return $ret;
    }
}