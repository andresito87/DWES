{include file="header.tpl" title="Confirmar eliminación"}
<div>
    {if isset($errores)}
        {include file="mostrarErrores.tpl" errores=$errores}
    {/if}
    <form action="index.php?accion=borrar_taller" method="post"><label for="confirmar">Marque la casilla de verificación
            para confirmar la eliminación</label>
        {if isset($id)}
            <input type="hidden" name="id" value="{$id}">
        {/if}
        <input type="checkbox" id="eliminar" name="eliminar" value="eliminar">
        <input type="hidden" name="confirmar" value="confirmar">
        <br>
        <input class="eliminar" type="submit" value="Confirmar elimninación">
    </form>
</div>
{include file="footer.tpl"}