<?php

namespace IMPR\modelo;

use \PDO;
use PDOException;

class Impresora
{
    public int $id;
    public string $marca;
    public string $modelo;
    public string $tipo;
    public string $color;
    public string $año;
    public float $coste;

    public function setMarca($marca): bool
    {
        $ret = false;
        if (!is_string($marca) || empty(trim($marca)))
            return $ret;
        $this->marca = $marca;
        return true;
    }


    public function guardar(PDO $pdo): bool
    {
        try {
            var_dump($this);
            $sql = "INSERT INTO impresoras (marca, modelo, tipo, color, año, coste)
            VALUES (:marca, :modelo, :tipo, :color, :year, :coste)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':marca', $this->marca);
            $stmt->bindParam(':modelo', $this->modelo);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':color', $this->color, PDO::PARAM_BOOL);
            $stmt->bindParam(':year', $this->año);
            $stmt->bindParam(':coste', $this->coste);
            $stmt->execute();
            return $stmt->rowCount()>0;
        }
        catch (PDOException $pdo)
        {
            var_dump($pdo);
            return false;
        }

    }
}
