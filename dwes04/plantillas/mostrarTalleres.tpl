<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid black;
        text-align: center;
        padding: 4px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ffc5c5;
    }

    label {
        font-weight: 800;
    }

    form input[type="submit"] {
        background-color: #08fb2c;
        color: black;
        padding: 6px 10px;
        text-align: center;
        font-weight: 800;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    form button[type="submit"] {
        background-color: #ff0e0e;
        color: black;
        font-weight: 800;
        padding: 6px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }
</style>
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
            <th>Eliminar</th>
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
                    <form action="index.php?accion=borrar_taller" method="post">
                        <input type="hidden" name="id" value="{$taller->getId()}">
                        <button type="submit" value="Eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>