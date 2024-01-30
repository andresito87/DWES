<?php

if (defined("SRC__DBUTIL_PHP")) return;
define("SRC__DBUTIL_PHP",1);

function doSQL(PDO $pdo,string $sql, array $data=[], bool $fetchFirst=false):array|int|bool
{
    $ret=false;
    try {
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($data)) {
            if (preg_match('/^\s*SELECT\s/i',$sql)) 
            {
                if ($fetchFirst) 
                    $ret=$stmt->fetch(PDO::FETCH_ASSOC);             
                else
                    $ret=$stmt->fetchAll(PDO::FETCH_ASSOC);                       
            }
            else
                $ret=$stmt->rowCount(); 
        } 
    } catch (PDOException $ex) {
        var_dump($ex);
        $ret=-1;
    } 
    return $ret;
}