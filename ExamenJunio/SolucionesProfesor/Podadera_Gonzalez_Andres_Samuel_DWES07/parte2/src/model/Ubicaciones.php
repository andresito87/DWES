<?php

namespace DWES07\model;

require_once __DIR__ . '/../../libs/dbutil.php';

use \PDO;
use PDOException;
use \PDOStatement;

class Ubicaciones
{
    public static function listarUbicaciones(PDO $pdo) : array
    {
        $sql = <<<ENDSQL
            SELECT id, nombre, descripcion, dias
            FROM ubicaciones;
        ENDSQL;

        $ret = false;
        try {
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute()) {
                if (preg_match('/^\s*SELECT\s/i', $sql)) {
                    $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else
                    $ret = $stmt->rowCount();
            }
        } catch (PDOException $ex) {
            $ret = -1;
        }

        $ubicaciones = [];
        if ($ret != false && $ret != -1)
            foreach ($ret as $reg) {
                $ubicaciones[] = Ubicacion::rescatar($pdo, $reg['id']);
            }
        return $ubicaciones;
    }
}