{include file="header.tpl" title="Formulario de Creación de un nuevo Taller"}
<div>
    <!--  Aunque los datos son verificados del lado del servidor, añado una sutíl comprobación con el atributo required en HTML   -->
    <h1>Ingrese los datos del nuevo taller</h1>
    <form class="nuevoTaller" action="index.php?accion=crear_taller" method="post">
        <label for="nombre">Nombre:</label>
        {if isset($nombre)}
            <input type=" text" name="nombre" id="nombre" value="{$nombre}">
        {else}
            <input type="text" name="nombre" id="nombre">
        {/if}
        <br>
        <label for="descripcion">Descripción:</label>
        {if isset($descripcion)}
            <input type="text" name="descripcion" id="descripcion" value="{$descripcion}">
        {else}
            <input type="text" name="descripcion" id="descripcion">
        {/if}
        <br>
        <label for="ubicacion">Ubicación:</label>
        {if isset($ubicacion)}
            <input type="text" name="ubicacion" id="ubicacion" value="{$ubicacion}">
        {else}
            <input type="text" name="ubicacion" id="ubicacion">
        {/if}
        <br>
        <label for="dia_semana">Día de la semana:</label>
        <select name="dia_semana" id="dia_semana">
            {if isset($dia_semana)}
                {foreach $dias_validos as $dia}
                    <option value="{$dia}" {if $dia == $dia_semana}selected{/if}>{$dia}</option>
                {/foreach}
            {else}
                {foreach $dias_validos as $dia}
                    <option value="{$dia}" {if $dia == $dia_actual}selected{/if}>{$dia}</option>
                {/foreach}
            {/if}
        </select>
        <br>
        <label for="hora_inicio">Hora de Inicio:</label>
        {if isset($hora_inicio)}
            <input type="time" name="hora_inicio" id="hora_inicio" value="{$hora_inicio->format('H:i')}">
        {else}
            <input type="time" name="hora_inicio" id="hora_inicio">
        {/if}
        <br>
        <label for="hora_fin">Hora de Fin:</label>
        {if isset($hora_fin)}
            <input type="time" name="hora_fin" id="hora_fin" value="{$hora_fin->format('H:i')}">
        {else}
            <input type="time" name="hora_fin" id="hora_fin">
        {/if}
        <br>
        <label for="cupo_maximo">Cupo Máximo:</label>
        {if isset($cupo_maximo)}
            <input type="text" name="cupo_maximo" id="cupo_maximo" value="{$cupo_maximo}">
        {else}
            <input type="text" name="cupo_maximo" id="cupo_maximo">
        {/if}
        <br>
        <input type="submit" value="Guardar">
    </form>
</div>
{include file="enlaceVolverAListadoTalleres.tpl"}
{include file="footer.tpl"}