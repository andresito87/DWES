<?php

class DB
{

    private static $conn = null;
    private static $lastError = '';

    public static function getConn()
    {
        if (!(static::$conn instanceof \PDO)) {
            try {
                static::$conn = new \PDO(
                    \DB_DSN,
                    \DB_USER,
                    \DB_PASSWD,
                    array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
                );
            } catch (\PDOException $e) {
                static::$lastError = 'Error DB. No se puede continuar. Revisa el valor de las constantes DB_USER y DB_PASSWD en el archivo conf.php.<BR>';
                static::$lastError.= $e->getMessage();
                static::$conn = false;
            }
        }
        return static::$conn;
    }

    public static function getLastError()
    {
        return static::$lastError;
    }

    public static function closeConn()
    {
        static::$conn = null;
    }

    public static function doSQL(PDO $pdo, string $sql, array $data = [], bool $fetchFirst = false): array|int|bool
    {
        $ret = false;
        try {
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute($data)) {
                if (preg_match('/^\s*SELECT\s/i', $sql)) {
                    if ($fetchFirst)
                        $ret = $stmt->fetch(PDO::FETCH_ASSOC);
                    else
                        $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else
                    $ret = $stmt->rowCount();
            }
        } catch (PDOException $ex) {
            var_dump($ex);
            $ret = -1;
        }
        return $ret;
    }
}
