<?php

namespace IMPR\controladores;

use Smarty;
use PDO;
use IMPR\modelo\Impresoras;
use IMPR\modelo\Impresora;

class ControladoresImpresoras
{

public static function listarImpresoras(PDO $pdo, Smarty $smarty)
{
    $impresoras=Impresoras::listar($pdo);
    $smarty->assign('impresoras',$impresoras);
    $smarty->display('impresoras.tpl');
}

public static function formCrearImpresora(Smarty $smarty)
{
    $smarty->display('formnewimpresora.tpl');
}

public static function guardarImpresora(PDO $pdo, Smarty $smarty)
{
    $impresora=new Impresora;
    
    $impresora->modelo=filter_input(INPUT_POST,'modelo',FILTER_SANITIZE_SPECIAL_CHARS);
    $impresora->tipo=filter_input(INPUT_POST,'tipo',FILTER_SANITIZE_SPECIAL_CHARS);
    $impresora->color=filter_input(INPUT_POST,'color',FILTER_SANITIZE_SPECIAL_CHARS);
    $impresora->año=filter_input(INPUT_POST,'year',FILTER_SANITIZE_SPECIAL_CHARS);
    $impresora->coste=filter_input(INPUT_POST,'coste',FILTER_SANITIZE_NUMBER_FLOAT);
    $impresora->color=$impresora->color=='si'?1:0;

    $check=true;
    $marca=filter_input(INPUT_POST,'marca',FILTER_SANITIZE_SPECIAL_CHARS);
    $check=$check && $impresora->setMarca($marca);
    
    if (!$check || !$impresora->modelo || !$impresora->tipo)
    {
        $smarty->assign('errors',['No están todos los datos']);
        $smarty->display('formnewimpresora.tpl');
    }
    else
    {
        if ($impresora->guardar($pdo))
        {
            header('Location:index.php');
        }
        else
        {
            $smarty->assign('errors',['No se ha podido guardar']);
            $smarty->display('formnewimpresora.tpl');
        }

    }

}

}