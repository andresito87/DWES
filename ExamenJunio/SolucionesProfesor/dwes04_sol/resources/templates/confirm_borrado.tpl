{if isset($errores)}
    {include 'errors.tpl' contexto='Errores al crear el taller' errores=$errores}
{/if}
<form action="?accion=borrar_taller" method="post">
    <label>
        <input type="checkbox" name="confirmacion" value="si">
        Marca la casilla para confirmar el borrado.
    </label><BR>
    <input type="hidden" name="id_taller" value="{$id_taller}">
    <input type="hidden" name="step" value="confirm">
    <input type="submit" value="Enviar!">
</form>