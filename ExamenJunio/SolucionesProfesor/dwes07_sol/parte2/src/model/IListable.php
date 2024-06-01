<?php

namespace DWES07\model;

use \PDO;

interface IListable {

    public static function listar(PDO $pdo): array | null;

};
