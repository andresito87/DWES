<?php

namespace IMPR\modelo;

use \PDO;

class Impresoras
{

    private array $impresoras;

    public static function listar(PDO $pdo):array
    {
        $array=[];
        $stmt=$pdo->query("SELECT * FROM impresoras");
        while ($impresora=$stmt->fetch())
        {
            $i=new Impresora;
            $i->id=$impresora['id'];
            $i->marca=$impresora['marca'];
            $i->color=$impresora['color'];
            $i->coste=$impresora['coste'];
            $i->modelo=$impresora['modelo'];
            $i->tipo=$impresora['tipo'];
            $i->año=$impresora['año'];
            $array[]=$i;
        }
        return $array;
    }



}


