<?php
/* 
   DNI:
   NOMBRE y APELLIDOS: 
*/

function obtenerEstadosAnimo()
{
   $arrayEstados = [];
   $fila = 0;
   if (($gestor = fopen("datos.csv", "r"))) {
      while (($datos = fgetcsv($gestor, 1000, ",")) !== false) {
         if (! in_array($datos[1], $arrayEstados) && $fila != 0) {
            $arrayEstados[] = $datos[1];
         }
         $fila++;
      }
      fclose($gestor);
      return $arrayEstados;
   } else {
      return false;
   }
}

function obtenerMensajeAnimo($estado)
{
   $arrayMensajes = [];
   $fila = 0;
   $estadosAnimo = obtenerEstadosAnimo();
   if (! in_array($estado, $estadosAnimo)) {
      return false;
   }
   if (($gestor = fopen("datos.csv", "r"))) {
      while (($datos = fgetcsv($gestor, 1000, ",")) !== false) {
         if ($datos[1] == $estado && $fila != 0) {
            $arrayMensajes[] = $datos[2];
         }
         $fila++;
      }
      if (count($arrayMensajes) == 1) {
         return $arrayMensajes;
      }
      return $arrayMensajes[rand(0, count($arrayMensajes) - 1)];
   } else {
      return false;
   }
}