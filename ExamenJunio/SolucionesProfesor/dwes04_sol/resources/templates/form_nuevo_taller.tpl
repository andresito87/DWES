{if isset($errores)}
    {include 'errors.tpl' contexto='Errores al crear el taller' errores=$errores}
{/if}
{assign var=dias value=['Lunes','Martes','Miércoles','Jueves','Viernes']}
{$dia=max(0,min(4,date('w')-1))}
<form action="?accion=crear_taller" method="post">
    <label>Nombre:
        <input id="nombre" type="text" name="nombre" value="{$datos.nombre|default:""|escape}">
    </label><BR>
    <label>Descripcion:
        <input id="descripcion" type="text" name="descripcion" value="{$datos.descripcion|default:""|escape}">
    </label><BR>
    <label>Ubicacion:
        <input id="ubicacion" type="text" name="ubicacion" value="{$datos.ubicacion|default:""|escape}">
    </label><BR>
    <label>
        Día de la semana:
        <select name="dia_semana">
            {foreach $dias as $num=>$diasem}
                <option value="{$diasem}" {if $num==$dia}selected{/if}>{$diasem}</option>
            {/foreach}
            <option value="ERROR">ERROR</option>
        </select>
    </label><BR>
    <label>Hora de inicio:
        <input id="hora_inicio" type="text" name="hora_inicio" value="{$datos.hora_inicio|default:""|escape}">
    </label><BR>
    <label>Hora de fin:
        <input id="hora_fin" type="text" name="hora_fin" value="{$datos.hora_fin|default:""|escape}">
    </label><BR>
    <label>Cupo máximo:
        <input id="cupo_maximo" type="text" name="cupo_maximo" value="{$datos.cupo_maximo|default:""|escape}">
    </label><BR>
    <input type="submit" value="Enviar!">
</form>