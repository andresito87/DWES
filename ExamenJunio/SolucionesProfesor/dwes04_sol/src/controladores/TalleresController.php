<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace DWES04SOL\controladores;

use \Peticion;
use \PDO;
use \Smarty;
use DWES04SOL\modelo\Talleres;
use DWES04SOL\modelo\Taller;

/**
 * Description of TalleresController
 *
 * @author salva
 */
class TalleresController {

    public static function listarTalleres(PDO $pdo, Smarty $smarty, Peticion $p) {
        $lista_talleres = [];
        if ($p->has('dia_semana')) {
            $lista_talleres = Talleres::filtrarPorDia($pdo, $p->getString('dia_semana'));
        } else {
            $lista_talleres = Talleres::listar($pdo);            
        }
        $smarty->assign('talleres', $lista_talleres);
        $smarty->display('listar_talleres.tpl');
    }

    public static function nuevoTallerForm(Smarty $smarty) {
        $smarty->display('form_nuevo_taller.tpl');
    }

    public static function crearTaller(PDO $pdo, Smarty $smarty, Peticion $p) {
        $errores = [];
        $datosok = [];
        $t = new Taller;
        foreach (['nombre' => 'String', 'descripcion' => 'String',
    'ubicacion' => 'String', 'dia_semana' => 'String',
    'hora_inicio' => 'String', 'hora_fin' => 'String',
    'cupo_maximo' => 'Int']
        as $dato => $obt) {
            try {
                if (!$p->has($dato))
                    $errores[] = "El atributo $dato no se ha enviado";
                elseif (!method_exists($t, 'set' . ucfirst($dato)))
                    $errores[] = "El metodo para establecer $dato no existe.";
                elseif (!$t->{'set' . ucfirst($dato)}($p->{'get' . $obt}($dato)))
                    $errores[] = "El atributo $dato no es válido";
                else
                    $datosok[$dato] = $p->getString($dato);
            } catch (\Exception $e) {
                $errores[] = $e->getMessage();
            }
        }
        if (empty($errores)) {
            $t->guardar($pdo);
            self::mostrarResultadoOp($smarty, 
                            "Se ha insertado un Taller con id {$t->getId()}");
        } else {
            $smarty->assign('datos', $datosok);
            $smarty->assign('errores', $errores);
            $smarty->display('form_nuevo_taller.tpl');
        }
    }

    public static function borrarTaller(PDO $pdo, Smarty $smarty, Peticion $p) {
        try {
            if ($p->isPost() && $p->has('id_taller') && $p->has('step')) {
                $id_taller = $p->getInt('id_taller');                
                $confirmacion = $p->has('confirmacion') ? $p->getString('confirmacion') : '';
                if ($confirmacion==="si")
                {
                    $r=Taller::borrar($pdo, $id_taller);
                    self::mostrarResultadoOp($smarty, 
                            "Se han borrado $r taller/es.");
                }
                else
                {
                    $smarty->assign('errores',['No se ha marcado la opcion de confirmación']);
                    $smarty->assign('id_taller',$id_taller);
                    $smarty->display('confirm_borrado.tpl');
                }
            }
            elseif ($p->isPost() && $p->has('id_taller'))
            {
                $smarty->assign('id_taller',$p->getInt('id_taller'));
                $smarty->display('confirm_borrado.tpl');
            }    
            else
            {
                self::mostrarResultadoOp($smarty, 
                            "[001] Error en datos recibidos.");
            }
        } catch (\Exception $e) {
            self::mostrarResultadoOp($smarty, 
                            "[002] Error en datos recibidos.");
        }
    }

    private static function mostrarResultadoOp(Smarty $s,string $resultado)
    {
        $s->assign('resultado',$resultado);
        $s->display('resultado_operacion.tpl');
    }
}
