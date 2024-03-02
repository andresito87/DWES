{include file="header.tpl" title="Listado de Talleres"}
{if isset($errores) && $errores!=null}
    {include file="mostrarErrores.tpl"}
{/if}
{if isset($mostrarFormularioFiltrarDia) && mostrarFormularioFiltrarDia==true}
    {include file="formularioFiltrarDia.tpl"}
{/if}
<h1>Listado de Talleres</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Ubicación</th>
            <th>Día de la Semana</th>
            <th>Hora de Inicio</th>
            <th>Hora de Fin</th>
            <th>Cupo Máximo</th>
            <th>Editar/Eliminar</th>
        </tr>
    </thead>
    <tbody>
        {foreach $talleres as $taller}
            <tr>
                <td>{$taller->getId()}</td>
                <td>{$taller->getNombre()}</td>
                <td>{$taller->getDescripcion()}</td>
                <td>{$taller->getUbicacion()}</td>
                <td>{$taller->getDiaSemana()}</td>
                <td>{$taller->getHoraInicio()|date_format:"%H:%M"}</td>
                <td>{$taller->getHoraFin()|date_format:"%H:%M"}</td>
                <td>{$taller->getCupoMaximo()}</td>
                <td>
                    <form action="index.php?accion=editar_taller_form" method="post">
                        <input type="hidden" name="id" value="{$taller->getId()}">
                        <button id="editar" type="submit" value="Editar">Editar</button>
                    </form>
                    <form action="index.php?accion=borrar_taller" method="post">
                        <input type="hidden" name="id" value="{$taller->getId()}">
                        <button class="eliminar" type="submit" value="Eliminar">Eliminar</button>
                    </form>

                </td>
            </tr>
        {/foreach}
    </tbody>
</table>
{include file="footer.tpl"}