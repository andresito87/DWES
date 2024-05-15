{if isset($talleres) && count($talleres)>0}
    <form action="">
        Dia de la semana: <input type="text" name="dia_semana" value="">
        <input type="submit" value="Filtrar!">
    </form>
    <table border="1" cellspacing="0" cellpadding="10px">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Ubicacion</th>
                <th>Dia de la semana</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Cupo</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            {foreach $talleres as $taller}
                <tr>
                    <td>{$taller->getId()}</td>
                    <td>{$taller->getNombre()|escape}</td>
                    <td>{$taller->getDescripcion()|escape}</td>
                    <td>{$taller->getUbicacion()|escape}</td>
                    <td>{$taller->getDia_semana()|escape}</td>
                    <td>{$taller->getHora_inicio()}</td>
                    <td>{$taller->getHora_fin()}</td>
                    <td>{$taller->getCupo_maximo()}</td>
                    <td>
                        <form action="?accion=borrar_taller" method="POST">
                            <input type="hidden" name="id_taller" value="{$taller->getId()}">
                            <input type="submit" value="¡Eliminar!">
                        </form>
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
{else}
    <h3>No hay talleres.</h3>
{/if}
<A href="?accion=nuevo_taller_form">Crear nuevo taller</a>
<A href="index.php">Listar todos los talleres</a>