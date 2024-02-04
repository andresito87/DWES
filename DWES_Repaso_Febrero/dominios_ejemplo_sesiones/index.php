<?php
define('PATRON',['/\b([a-zA-Z0-9-]+(?:\.[a-zA-Z]{2,})+)\b/']);
session_start();
if (!isset($_SESSION['estadisticas']))$_SESSION['estadisticas']=[];

$texto=filter_input(INPUT_POST,'texto');
if (!is_null($texto))
{
    if (preg_match_all(PATRON[0], $texto, $matches))
    {
        foreach($matches[1] as $dominio)
        {
            $partes=preg_split("/\./",$dominio);
            $extension=array_pop($partes);
            echo "$extension encontrada<BR>";
            if (isset($_SESSION['estadisticas'][$extension]))
                $_SESSION['estadisticas'][$extension]++;
            else
                $_SESSION['estadisticas'][$extension]=1;
        }   
    }
}

var_dump($_SESSION['estadisticas']);

?>
<form action="" method="post">
    <textarea name="texto" id="" cols="30" rows="10"></textarea>
    <input type="submit" value="Enviar!">
</form>