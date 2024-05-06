<?php

namespace DWES07\model;

require_once __DIR__ . '/../../libs/dbutil.php';

use \JsonSerializable;
use \PDOException;
use \PDO;


class Ubicacion {
    
    public const DIAS=['L','M','X','J','V','S','D'];

    public static function listarUbicaciones(PDO $pdo): array {
        $sql=<<<ENDSQL
            SELECT id, nombre, descripcion, dias
            FROM ubicaciones;
        ENDSQL;
        return doSQL($pdo,$sql);
    }

}
