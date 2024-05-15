<?php

namespace DWES04SOL\modelo;

use Exception;
use \PDO;
use PDOException;

class Taller extends Modelo
{

    public const dias = ['lunes' => 'Lunes',
        'martes' => 'Martes',
        'miercoles' => 'Miércoles',
        'jueves' => 'Jueves',
        'viernes' => 'Viernes'];

    public const NULLABLE_FIELDS = ['id', 'descripcion', 'ubicacion', 'cupo_maximo'];

    private ?string $nombre = null;//nombre VARCHAR(255) NOT NULL,
    private ?string $descripcion = null;//descripcion TEXT,
    private ?string $ubicacion = null;//ubicacion VARCHAR(255),
    private ?string $dia_semana = null;//dia_semana VARCHAR(20) NOT NULL,
    private ?string $hora_inicio = null;//hora_inicio TIME NOT NULL,
    private ?string $hora_fin = null;//hora_fin TIME NOT NULL,
    private ?int $cupo_maximo = null;//cupo_maximo INT,



    public function getNombre() : string
    {
        return $this->nombre;
    }

    public function getDescripcion() : string
    {
        return $this->descripcion;
    }

    public function getUbicacion() : string
    {
        return $this->ubicacion;
    }

    public function getDia_semana() : string
    {
        return $this->dia_semana;
    }

    public function getHora_inicio() : string
    {
        return $this->hora_inicio;
    }

    public function getHora_fin() : string
    {
        return $this->hora_fin;
    }

    public function getCupo_maximo() : int
    {
        return $this->cupo_maximo;
    }

    public function setNombre(string $nombre) : bool
    {
        if (empty($nombre) || strlen($nombre) > 255)
            return false;
        $this->nombre = $nombre;
        return true;
    }

    public function setDescripcion(string $descripcion) : bool
    {
        if (empty($descripcion) || strlen($descripcion) > 65535)
            return false;
        $this->descripcion = $descripcion;
        return true;
    }

    public function setUbicacion(string $ubicacion)
    {
        if (empty($ubicacion) || strlen($ubicacion) > 255)
            return false;
        $this->ubicacion = $ubicacion;
        return true;
    }

    public function setDia_semana(string $dia_semana)
    {
        if (! in_array($dia_semana, Taller::dias)) {
            if (array_key_exists($dia_semana, Taller::dias)) {
                $dia_semana = Taller::dias[$dia_semana];
            } else
                return false;
        }
        $this->dia_semana = $dia_semana;
        return true;
    }

    public function setHora_inicio(string $hora_inicio)
    {
        if (! preg_match('/^[0-5][0-9]:[0-9]{2}$/', $hora_inicio))
            return false;
        $this->hora_inicio = $hora_inicio;
        return true;
    }

    public function setHora_fin(string $hora_fin) : bool
    {
        if (! preg_match('/^[0-5][0-9]:[0-9]{2}$/', $hora_fin))
            return false;
        $this->hora_fin = $hora_fin;
        return true;
    }

    public function setCupo_maximo(int $cupo_maximo) : bool
    {
        if ($cupo_maximo < 5 || $cupo_maximo > 30)
            return false;
        $this->cupo_maximo = $cupo_maximo;
        return true;
    }

    public function guardar(PDO $pdo)
    {
        $arrayDatos = get_object_vars($this);
        //Comprobamos si alguno de los campos obligatorios es null
        if (in_array(null, array_diff_key($arrayDatos, array_flip(Taller::NULLABLE_FIELDS)))) {
            return -2;//Existen datos null en campos obligatorios
        }
        if ($this->getId() !== null) {
            $sets = implode(",", array_map(fn ($campo) => $campo . '=:' . $campo, array_keys($arrayDatos)));
            $SQL = "UPDATE talleres SET $sets WHERE id=:id";
            $arrayDatos['id'] = $this->getId();
            unset($sets);
        } else {
            $fields = implode(",", array_keys($arrayDatos));
            $values = implode(",", array_map(fn ($dato) => ':' . $dato, array_keys($arrayDatos)));
            $SQL = "INSERT INTO talleres ( $fields ) VALUES ($values)";
            unset($fields);
            unset($values);
        }
        try {
            $stmt = $pdo->prepare($SQL);
            if ($stmt->execute($arrayDatos)) {
                if ($this->getId() === null) {
                    $this->setId($pdo->lastInsertId());
                }
                return $stmt->rowCount();
            }
        } catch (PDOException $ex) {
            var_dump($ex);
        }
        return false;
    }

    public static function borrar(PDO $pdo, int $id) : bool|int
    {
        $SQL = "DELETE FROM talleres WHERE id=:id";
        try {
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue('id', $id);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        } catch (PDOException $ex) {
            var_dump($ex);
        }
        return false;
    }

    public static function rescatar(PDO $pdo, int $id) : Taller|bool
    {
        $SQL = "SELECT * FROM talleres WHERE id=:id";
        $resultado = false;
        try {
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue('id', $id);
            if ($stmt->execute())
                $resultado = $stmt->fetchObject(__CLASS__);
            if ($resultado instanceof Taller) {
                $id_taller = $resultado->getId();
                $resultado->setId($id_taller);
                unset($id_taller);
            }
        } catch (Exception $ex) {
            var_dump($ex);
        }
        return $resultado;
    }

}
