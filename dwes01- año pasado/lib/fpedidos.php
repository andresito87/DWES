<?php
/*
* Librería con funciones sobre los pedidos.
*/

/**
 * Añadir una línea al pedido.
 * 
 * La función añade una línea al pedido sin comprobar
 * si el número de unidades es correcto ni tampoco si el código de producto existe.
 * 
 * @param array[] $pedido Array que contiene el pedido sobre el que se añadirá una línea de pedido.
 * @param string $codigoProducto Código del producto a insertar.
 * @param int $unidades Unidades a insertar en el pedido.
 * 
 * @return int Número de líneas de pedido en el pedido.
 */
function addLineaPedido(array &$pedido, string $codigoProducto, int $unidades ): int
{
    $linea['producto']=$codigoProducto;
    $linea['unidades']=$unidades;
    array_push($pedido, $linea);    
    return count ($pedido);
}


/**
 * Comprobar si un producto existe.
 * 
 * @param string $codigoProducto Código del producto de la línea del pedido.
 * @param array[] $productos Array que contiene los productos disponibles, descripción y coste. 
 *
 * @return bool true si el producto existe y false en caso contrario
 */
 function existeProducto(string $codigoProducto, array $productos): bool
 {
    return array_key_exists($codigoProducto,$productos); 
 }

/**
 * Calcular coste de línea de pedido.
 * 
 * @param string $codigoProducto Código del producto de la línea del pedido.
 * @param int $unidades Número de unidades del producto a pedir.
 * @param array[] $productos Array que contiene los productos disponibles, descripción y coste. 
 *
 * @return float Coste de la línea de producto o "-1" si dicho producto no existe.
 */
function costLineaPedido(string $codigoProducto, int $unidades, array $productos): float
{
    if (existeProducto($codigoProducto,$productos))
    {
        return $productos[$codigoProducto]['precio_unidad']*$unidades;
    }
    else return -1;
}


/**
 * Completa la información de pedido y calcula su coste.
 * 
 * @param string $codigoProducto Código del producto de la línea del pedido.
 * @param int $unidades Número de unidades del producto a pedir.
 * @param array[] $productos Array que contiene los productos disponibles, descripción y coste. 
 *
 * @return float Coste de la línea de producto o "-1" si dicho producto no existe.
 */
function costePedido(array &$pedido, array $productos)
{
    $costePedido=0;
    foreach($pedido as $n=>&$linea)
    {
        $coste=costLineaPedido($linea['producto'], $linea['unidades'], $productos);
        if ($coste>0)
        {
            $linea['descripcion']=$productos[$linea['producto']]['descripcion'];
            $linea['coste_unidad']=$productos[$linea['producto']]['precio_unidad'];
            $linea['coste_linea']=$coste;
            $costePedido+=$coste;
        }
        else
        {
            unset ($pedido[$n]);
        }
    }
    return $costePedido;
}

function generarOptions($productos,$selectedcode='')
{
    $options='';
    $notSelected=true;    
    foreach ($productos as $code=>$prodata)
    {
        extract($prodata);
        $select=$code==$selectedcode ? 'selected' : '';        
        $notSelected=$notSelected && $select=='';
        $options.="<option value='$code' $select>$descripcion [$precio_unidad €]</code>";        
    }
    if ($notSelected)
    {
        $options='<option value="" selected></option>'.$options;
    }
    else
    {
        $options='<option value=""></option>'.$options;
    }

    $options='<option value="NOEXISTE" >Producto no existente(TEST)</option>'.$options;

    return $options;
}