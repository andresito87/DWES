<?php
require_once __DIR__.'/vendor/autoload.php';

use Jaxon\Jaxon;
use function Jaxon\jaxon; 

jaxon()->callback()->before(function($target, &$endr)
{
    session_start();
    if (!isset($_SESSION['numeros'])) $_SESSION['numeros']=[];        
});

function nuevonumero($numero)
{
    $response = jaxon()->newResponse();
    if (!preg_match('/^\d+$/',$numero))
        {
            $response->alert("No se ha indicado un número");
        }

    if (!in_array($numero,$_SESSION['numeros'])) {
                $_SESSION['numeros'][]=$numero;
                $response->call('jaxon_listarnumeros');
                $response->alert("Numero $numero insertado!");
    }
    else $response->alert('El número ya está en la lista!');
    $response->jq("#numero")->val("");   
    return $response;
}

function listarnumeros()
{
    $response = jaxon()->newResponse();     
    $response->clear('listaDeNumeros');
    foreach($_SESSION['numeros'] as $numero)
        $response->append('listaDeNumeros','innerHTML',$numero.'<BR>');    
    return $response;
}

function cambiarnumero($datos)
{
    $response = jaxon()->newResponse();  
    if (!isset($datos['numero_nuevo']) || !preg_match('/^\d+$/',$datos['numero_nuevo']))        
        { $response->alert('El nuevo número no es correcto.'); return $response; }
    if (!isset($datos['numero_actual']) || !preg_match('/^\d+$/',$datos['numero_actual']))        
        { $response->alert('El número actual no es correcto.'); return $response; }
    $numero_nuevo=intval($datos['numero_nuevo']);
    $numero_actual=intval($datos['numero_actual']);
    if (!in_array($numero_actual,$_SESSION['numeros']))
        { $response->alert('El número "actual" no está en la lista de números.'); return $response; }
    if (in_array($numero_nuevo,$_SESSION['numeros']))
        { $response->alert('El número "nuevo" ya está en la lista de números.'); return $response; }
    $pos=array_search($numero_actual,$_SESSION['numeros']);
    $_SESSION['numeros'][$pos]=$numero_nuevo;    
    $response->call('jaxon_listarnumeros');
    $response->script('$("#cambiarnumero")[0].reset();');
    return $response;
}

function borrarNumero($numero)
{
    $response = jaxon()->newResponse();  
    if (!preg_match('/^\d+$/',$numero))        
        { $response->alert('El número a borrar no es correcto.'); return $response; }    
    $numero=intval($numero);
    if (!in_array($numero,$_SESSION['numeros'])) 
    {
        $response->alert('El número indicado no está en la lista.');
        $response->assign('numeroABorrar','value','');
        return $response; 
    }

    $pos=array_search($numero,$_SESSION['numeros']);
    unset($_SESSION['numeros'][$pos]);
    $_SESSION['numeros']=array_values($_SESSION['numeros']);
    $response->call('jaxon_listarnumeros');
    $response->assign('numeroABorrar','value','');

    return $response;
}

jaxon()->register(Jaxon::CALLABLE_FUNCTION, 'nuevonumero');
jaxon()->register(Jaxon::CALLABLE_FUNCTION, 'listarnumeros');
jaxon()->register(Jaxon::CALLABLE_FUNCTION, 'cambiarnumero');
jaxon()->register(Jaxon::CALLABLE_FUNCTION, 'borrarnumero');