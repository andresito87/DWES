{include file="header.tpl" title="Confirmar eliminación"}
<div>
    <form action="index.php?accion=borrar_taller" method="post"><label for="confirmar">Marque la casilla de verificación
            para confirmar la eliminación</label><input type="hidden" name="id" value="{$id}">
        <input type="checkbox" id="eliminar" name="eliminar" value="eliminar">
        <br>
        <input class="eliminar" type="submit" value="Confirmar elimninación">
    </form>
</div>
{include file="footer.tpl"}