<?php

namespace DWES07\model;

use \PDO;

interface IGuardable {

    public function guardar(PDO $pdo): bool | int;

    public static function rescatar(PDO $pdo, int $id): object | null;

    public static function borrar(PDO $pdo, int $id): bool | int;
};
