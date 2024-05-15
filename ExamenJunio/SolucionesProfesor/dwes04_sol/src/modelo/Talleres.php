<?php

namespace DWES04SOL\modelo;

use \PDO;
use \PDOStatement;

class Talleres {

    private static function recogerTalleres(PDO $pdo, PDOStatement $stmt): array {
        $talleres = [];
        foreach ($stmt as $reg) {
            $talleres[] = Taller::rescatar($pdo, $reg['id']);
        }
        return $talleres;
    }

    public static function listar(PDO $pdo): array|bool {
        $SQL = "SELECT id FROM talleres";
        try {
            $stmt = $pdo->query($SQL);
            return self::recogerTalleres($pdo, $stmt);
        } catch (PDOException $ex) {
            return false;
        }
    }
    
    public static function filtrarPorDia(PDO $pdo, $dia_semana): array|bool {
        $SQL = "SELECT id FROM talleres WHERE LOWER(dia_semana) like LOWER(:dia_semana)";
        try {
            $stmt = $pdo->prepare($SQL);
            $stmt->bindValue('dia_semana', $dia_semana);
            if ($stmt->execute())
            {
                return self::recogerTalleres($pdo, $stmt);
            }
        } catch (PDOException $ex) {
            return false;
        }
    }

}
