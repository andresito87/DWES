<?php /* Requiere de la existencia de $archivo (nombre del archivo con el fragmento mostrado)
         o $longitud (longitud de la cadena de carácteres mostrada),
         sin no existen, no se muestra nada en el footer. */ ?>
<footer>
<?php
    if (isset($archivo))
    {
        echo "Fecha y hora del documento: ";
        echo date('d/m/Y h:m',filemtime($archivo));
    }
    elseif (isset($longitud))
    {
        echo "Longitud del documento: $longitud carácteres";
    }

    //TODO: muestra la lista de secciones visitadas 
?>

<?php
/*** TAREA 3 ****/
if (isset($lista))
{
    echo '<BR><BR>Últimas páginas visitadas<BR>';
    echo '<UL>';
    array_walk($lista,fn($e)=>print('<LI><A href="?ver='.urlencode($e[0]).'">'.$e[1].'<SMALL> ('.date('d/m/Y h:s',$e[2]).')</SMALL></A>'));
    echo '</UL>';
}
/*** FIN TAREA 3 ****/
?>
<BR>
<BR>
</footer>