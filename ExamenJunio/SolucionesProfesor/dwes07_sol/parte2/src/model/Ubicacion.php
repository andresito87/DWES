<?php

namespace DWES07\model;

use \JsonSerializable;
use \PDOException;
use \PDO;

class Ubicacion implements IGuardable, IListable, JsonSerializable {
    private ?int $id=null;
    private ?string $nombre=null;
    private ?string $descripcion=null;
    private ?array $dias=[];

    public const DIAS=['L','M','X','J','V','S','D'];

    public function getId():?string
    {
        return $this->id;
    }

    public function getNombre():?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre):bool
    {
        if (!is_string($nombre=trim($nombre))
            || strlen($nombre)<=4 || strlen($nombre)>50) return false;
        $this->nombre=$nombre;
        return true;
    }

    public function getDescripcion():?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion):bool
    {
        if (!is_string($descripcion=trim($descripcion)) ||
            strlen($descripcion)===0) return false;
        $this->descripcion=$descripcion;
        return true;
    }

    public function getDias():?array
    {
        return $this->dias;
    }

    public function setDias(array $dias):bool
    {
        if ($dias!==array_unique($dias)) return false;
        if (!empty(array_diff($dias,static::DIAS))) return false;
        $this->dias=$dias;
        return true;
    }



    public function guardar(PDO $pdo): bool | int
    {
        try
        {
            if ($this->id==null)
            {
                unset($data['id']);
                $sql="INSERT INTO ubicaciones (nombre,descripcion,dias, created_at, updated_at) VALUES (:nombre,:descripcion,:dias, now(), now())";
                $stmt=$pdo->prepare($sql);

            }
            else
            {
                $sql="UPDATE ubicaciones set nombre=:nombre, descripcion=:descripcion, dias=:dias, update_at=now() WHERE id=:id";
                $stmt=$pdo->prepare($sql);
                $stmt->bindValue("id",$this->getId());

            }
            $stmt->bindValue("nombre",$this->getNombre());
            $stmt->bindValue("descripcion",$this->getDescripcion());
            $stmt->bindValue("dias",implode(",",$this->getDias()));
            if ($stmt->execute())
            {
                $ret=$stmt->rowCount();
                if ($ret>0 && !isset($this->id))
                {
                        $this->id=$pdo->lastInsertId();
                }
                return $ret;
            }
            return false;

        } catch (PDOException $e)
        {
            if ($e->getCode()==='23000')
            {
                return -2;
            }
            var_dump($e);
            return -1;
        }

    }

    public static function rescatar(PDO $pdo, int $id): object | null
    {
        $sql="SELECT id, nombre, descripcion, dias from ubicaciones WHERE id=:id";
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam('id',$id);
            if ($stmt->execute())
            {
                $data=$stmt->fetch(PDO::FETCH_ASSOC);
                if ($data) {
                    $ubicacion=new static();
                    $ubicacion->id=$id;
                    $ubicacion->nombre=$data['nombre'];
                    $ubicacion->descripcion=$data['descripcion'];
                    $ubicacion->dias=explode(',',$data['dias']);
                    return $ubicacion;
                }
                else return null;
            }
            else
                return null;
        }
        catch (PDOException $e)
        {
            return null;
        }
    }

    public static function borrar(PDO $pdo, int $id): bool | int
    {
        $sql="DELETE FROM ubicaciones WHERE id=:id";
        try {
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam('id',$id);
            if ($stmt->execute())
            {
                return $stmt->rowCount();
            }
            else
                return false;
        }
        catch (PDOException $e)
        {
            return false;
        }
    }

    public static function listar(PDO $pdo): ?array
    {
        $sql="SELECT id from ubicaciones";
        try {
            $stmt=$pdo->prepare($sql);
            if ($stmt->execute())
            {
                $ubicaciones=[];
                while ($id=$stmt->fetchColumn()) $ubicaciones[]=static::rescatar($pdo,$id);
                return $ubicaciones;
            }
            else
                return null;
        }
        catch (PDOException $e)
        {
            var_dump($e);
            return null;
        }
    }

    public function jsonSerialize(): mixed
    {
        $pdata=new class {};
        $pdata->id = $this->id;
        $pdata->nombre = $this->nombre;
        $pdata->descripcion = $this->descripcion;
        $pdata->dias = $this->dias;
        return $pdata;
    }

}
