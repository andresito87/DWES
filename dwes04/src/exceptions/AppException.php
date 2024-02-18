<?php

namespace DWES04\exceptions;

use Exception;

/**
 * Clase que gestiona las excepciones de la aplicación.
 * 
 * Permite gestionar las excepciones que se produzcan en la aplicación.
 * 
 * @package DWES04\exceptions
 * @author Profesor
 * @uses Exception https://www.php.net/manual/es/class.exception.php
 * @version 1.0
 */
class AppException extends Exception
{
    /**
     * Base de datos no disponible.
     */
    public const DB_UNABLE_TO_CONNECT = 100;

    /**
     * No se pudo conectar a la base de datos.
     */
    public const DB_NOT_CONNECTED = 101;

    /**
     * No se pudo ejecutar la consulta.
     */
    public const DB_QUERY_EXECUTION_FAILURE = 102;

    /**
     * Violación de una restricción de la base de datos.
     */
    public const DB_CONSTRAINT_VIOLATION_IN_QUERY = 103;

    /**
     * Error en la consulta.
     */
    public const DB_ERROR_IN_QUERY = 104;
}