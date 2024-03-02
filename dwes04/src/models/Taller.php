<?php

namespace DWES04\models;

use PDO;
use DateTime;
use DWES04\models\IGuardable;
use PDOException;

/**
 * Clase que representa un taller.
 * 
 * Los talleres son actividades que se realizan en un día de la semana, en un horario determinado,
 * en una ubicación concreta y con un cupo máximo de participantes.
 * 
 * @implements IGuardable
 * @package DWES04\models
 * @author Andrés Samuel Podadera González
 * @uses IGuardable DWES04\models\IGuardable
 * @uses PDO https://www.php.net/manual/es/class.pdo.php
 * @uses DateTime https://www.php.net/manual/es/class.datetime.php
 * @uses PDOException https://www.php.net/manual/es/class.pdoexception.php
 * @version 1.0
 */
class Taller implements IGuardable
{
    /**
     * @var int|null Identificador del taller. Es null si el taller no ha sido guardado en la base de datos.
     */
    private $id = null;

    /**
     * @var string Nombre del taller.
     */
    private $nombre;

    /**
     * @var string Descripción del taller.
     */
    private $descripcion;

    /**
     * @var string Ubicación del taller.
     */
    private $ubicacion;

    /**
     * @var string Día de la semana en el que se realiza el taller(Del lunes al viernes)
     */
    private $dia_semana;

    /**
     * @var DateTime Hora de inicio del taller.
     */
    private $hora_inicio;

    /**
     * @var DateTime Hora de fin del taller.
     */
    private $hora_fin;

    /**
     * @var int Cupo máximo de participantes en el taller.
     */
    private $cupo_maximo;

    /**
     * Retorna el identificador del taller.
     * @return int|null Identificador del taller.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Retorna el nombre del taller.
     * @return string Nombre del taller.
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Establece el nombre del taller.
     * @param string $nombre Nombre del taller.
     * @return bool true si el nombre es válido y se ha establecido, false en caso contrario.
     * @see https://www.php.net/manual/es/function.strlen.php
     */
    public function setNombre(string $nombre): bool
    {
        if (!is_string($nombre) || strlen($nombre) <= 0) {
            return false;
        }
        $this->nombre = $nombre;
        return true;
    }

    /**
     * Retorna la descripción del taller.
     * @return string Descripción del taller.
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Establece la descripción del taller.
     * @param string $descripcion Descripción del taller.
     * @return bool true si la descripción es válida y se ha establecido, false en caso contrario.
     * @see https://www.php.net/manual/es/function.strlen.php
     */
    public function setDescripcion(string $descripcion): bool
    {
        if (!is_string($descripcion) || strlen($descripcion) <= 0) {
            return false;
        }
        $this->descripcion = $descripcion;
        return true;
    }

    /**
     * Retorna la ubicación del taller.
     * @return string Ubicación del taller.
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Establece la ubicación del taller.
     * @param string $ubicacion Ubicación del taller.
     * @return bool true si la ubicación es válida y se ha establecido, false en caso contrario.
     * @see https://www.php.net/manual/es/function.strlen.php
     */
    public function setUbicacion(string $ubicacion): bool
    {
        if (!is_string($ubicacion) || strlen($ubicacion) <= 0) {
            return false;
        }
        $this->ubicacion = $ubicacion;
        return true;
    }

    /**
     * Retorna el día de la semana en el que se realiza el taller.
     * @return string Día de la semana en el que se realiza el taller.
     */
    public function getDiaSemana()
    {
        return $this->dia_semana;
    }

    /**
     * Establece el día de la semana en el que se realiza el taller.
     * @param string $dia_semana Día de la semana en el que se realiza el taller.
     * @return bool true si el día de la semana es válido y se ha establecido, false en caso contrario.
     * @see https://www.php.net/manual/es/function.in-array.php
     */
    public function setDiaSemana(string $dia_semana): bool
    {
        $diasValidos = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        if (!is_string($dia_semana) || !in_array($dia_semana, $diasValidos)) {
            return false;
        }
        $this->dia_semana = $dia_semana;
        return true;
    }

    /**
     * Retorna la hora de inicio del taller.
     * @return DateTime Hora de inicio del taller.
     */
    public function getHoraInicio()
    {
        return $this->hora_inicio;
    }

    /**
     * Establece la hora de inicio del taller.
     * @param DateTime $hora_inicio Hora de inicio del taller.
     * @return bool true si la hora de inicio es válida y se ha establecido, false en caso contrario.
     * @see https://www.php.net/manual/es/function.preg-match.php
     */
    public function setHoraInicio(DateTime $hora_inicio): bool
    {
        // Transformar la hora a string
        $hora_inicio_string = $hora_inicio->format('H:i');
        // Validar el formato HH:MM y que la hora de inicio sea menor que la hora de fin, consistente con el check de la base de datos
        // Se controla el caso en el que el orden de ejecución de los metodos setHoraInicio y setHoraFin no sea un orden lógico
        if (!preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $hora_inicio_string) || (isset($this->hora_fin) && $hora_inicio >= $this->hora_fin)) {
            return false;
        }
        $this->hora_inicio = $hora_inicio;
        return true;
    }

    /**
     * Retorna la hora de fin del taller.
     * @return DateTime Hora de fin del taller.
     */
    public function getHoraFin()
    {
        return $this->hora_fin;
    }

    /**
     * Establece la hora de fin del taller.
     * @param DateTime $hora_fin Hora de fin del taller.
     * @return bool true si la hora de fin es válida y se ha establecido, false en caso contrario.
     * @see https://www.php.net/manual/es/function.preg-match.php
     */
    public function setHoraFin(DateTime $hora_fin): bool
    {
        // Transformar la hora a string
        $hora_fin_string = $hora_fin->format('H:i');
        // Validar el formato HH:MM y que la hora de fin sea mayor que la hora de inicio,consistente con el check de la base de datos
        if (!preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $hora_fin_string) || $hora_fin <= $this->hora_inicio) {
            return false;
        }
        $this->hora_fin = $hora_fin;
        return true;
    }

    /**
     * Retorna el cupo máximo de participantes en el taller.
     * @return int Cupo máximo de participantes en el taller.
     */
    public function getCupoMaximo()
    {
        return $this->cupo_maximo;
    }

    /**
     * Establece el cupo máximo de participantes en el taller.
     * @param int $cupo_maximo Cupo máximo de participantes en el taller.
     * @return bool true si el cupo máximo es válido y se ha establecido, false en caso contrario.
     * @see https://www.php.net/manual/es/function.preg-match.php
     */
    public function setCupoMaximo(int $cupo_maximo): bool
    {
        if (!is_int($cupo_maximo) || $cupo_maximo < 5 || 30 < $cupo_maximo) {
            return false;
        }
        $this->cupo_maximo = $cupo_maximo;
        return true;
    }

    /**
     * Guarda el taller en la base de datos.
     * 
     * Si el taller se ha guardado correctamente, se actualiza el atributo id del objeto taller con el identificador
     * autogenerado por la base de datos.
     * 
     * @param PDO $con Conexión a la base de datos.
     * @return bool|int el número de talleres guardados si el guradado se ha realizado correctamente,
     * false sino se guardó ningún taller o si se ha producido una excepción en la operación.
     * @see https://www.php.net/manual/es/book.pdo.php
     */
    public function guardar(PDO $con): bool|int
    {
        try {
            $sql = "INSERT INTO talleres (nombre, descripcion, ubicacion, dia_semana, hora_inicio, hora_fin, cupo_maximo) VALUES (:nombre,:descripcion, :ubicacion, :dia_semana, :hora_inicio, :hora_fin, :cupo_maximo)";

            $statement = $con->prepare($sql);

            // Bind de los valores a los parámetros de la consulta
            $statement->bindParam(':nombre', $this->nombre);
            $statement->bindParam(':descripcion', $this->descripcion);
            $statement->bindParam(':ubicacion', $this->ubicacion);
            $statement->bindParam(':dia_semana', $this->dia_semana);
            $hora_inicio_string = $this->hora_inicio->format('H:i');
            $statement->bindParam(':hora_inicio', $hora_inicio_string);
            $hora_fin_string = $this->hora_fin->format('H:i');
            $statement->bindParam(':hora_fin', $hora_fin_string);
            $statement->bindParam(':cupo_maximo', $this->cupo_maximo);

            // Ejecutar la consulta
            if ($statement->execute()) {
                // Obtener el ID autogenerado
                $id_autogenerado = $con->lastInsertId();
                // Actualizar el atributo id del objeto taller
                $this->id = $id_autogenerado;
                // Devolver el número de filas creadas
                return $statement->rowCount();
            } else {
                // No se ejecutó la consulta
                return false;
            }
        } catch (PDOException $e) {
            // Se ha producido una excepción
            return false;
        }
    }

    /**
     * Recupera un taller de la base de datos.
     * 
     * @param PDO $con Conexión a la base de datos.
     * @param int $id Identificador del taller.
     * @return Taller|bool|int El taller si se ha recuperado correctamente, false si no se ha encontrado el taller 
     * o si se ha producido una excepción en la operación.
     * @see https://www.php.net/manual/es/book.pdo.php
     */
    public static function rescatar(PDO $con, int $id): Taller|bool|int
    {
        try {
            $sql = "SELECT * FROM talleres WHERE id = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                if ($tallerData = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $taller = new Taller();
                    $taller->id = $tallerData['id'];
                    $taller->nombre = $tallerData['nombre'];
                    $taller->descripcion = $tallerData['descripcion'];
                    $taller->ubicacion = $tallerData['ubicacion'];
                    $taller->dia_semana = $tallerData['dia_semana'];
                    $taller->hora_inicio = new DateTime($tallerData['hora_inicio']);
                    $taller->hora_fin = new DateTime($tallerData['hora_fin']);
                    $taller->cupo_maximo = $tallerData['cupo_maximo'];
                    return $taller;
                } else { // No se encontró el taller
                    return false;
                }
            } else {
                // No se ejecutó la consulta
                return false;
            }
        } catch (PDOException $e) {
            // Se ha producido una excepción
            return false;
        }
    }

    /**
     * Permite borrar un taller de la base de datos.
     * 
     * @param PDO $con Conexión a la base de datos.
     * @param int $id Identificador del taller.
     * @return bool|int el número de filas eliminadas si el proceso se realizó correctamente,
     * 0 si no se ha borrado ningún taller y false si se ha producido una excepción en la operación.
     */
    public static function borrar(PDO $con, int $id): bool|int
    {
        try {
            $sql = "DELETE FROM talleres WHERE id = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Permite actualizar un taller en la base de datos.
     * 
     * @param PDO $con Conexión a la base de datos.
     * @param int $id Identificador del taller.
     * @return bool|int el número de filas actualizadas si el proceso se realizó correctamente,
     * 0 si no se ha actualizado ningún taller y false si se ha producido una excepción en la operación.
     */
    public function actualizar(PDO $con, int $id): bool|int
    {
        try {
            $sql = "UPDATE talleres SET nombre = :nombre, descripcion = :descripcion, ubicacion = :ubicacion, dia_semana = :dia_semana, hora_inicio = :hora_inicio, hora_fin = :hora_fin, cupo_maximo = :cupo_maximo WHERE id = :id";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':descripcion', $this->descripcion);
            $stmt->bindParam(':ubicacion', $this->ubicacion);
            $stmt->bindParam(':dia_semana', $this->dia_semana);
            $hora_inicio_string = $this->hora_inicio->format('H:i');
            $stmt->bindParam(':hora_inicio', $hora_inicio_string);
            $hora_fin_string = $this->hora_fin->format('H:i');
            $stmt->bindParam(':hora_fin', $hora_fin_string);
            $stmt->bindParam(':cupo_maximo', $this->cupo_maximo);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
    }
}