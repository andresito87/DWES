<style>
    h1 {
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: large;
        font-weight: bold;
    }

    input,
    select {
        margin: 10px;
        padding: 5px;
    }

    input[type="submit"] {
        margin: 20px;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        font-size: x-large;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
<div>
    <!--  Aunque los datos son verificados del lado del servidor, añado una sutíl comprobación con el atributo required en HTML   -->
    <h1>Ingrese los datos del nuevo taller</h1>
    <form action="index.php?accion=crear_taller" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" id="descripcion" required>
        <br>
        <label for="ubicacion">Ubicación:</label>
        <input type="text" name="ubicacion" id="ubicacion" required>
        <br>
        <label for="dia_semana">Día de la semana:</label>
        <select name="dia_semana" id="dia_semana" required>
            {foreach $dias_validos as $dia}
                <option value="{$dia}" {if $dia == $dia_actual}selected{/if}>{$dia}</option>
            {/foreach}
        </select>
        <br>
        <label for="hora_inicio">Hora de Inicio:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" required>
        <br>
        <label for="hora_fin">Hora de Fin:</label>
        <input type="time" name="hora_fin" id="hora_fin" required>
        <br>
        <label for="cupo_maximo">Cupo Máximo:</label>
        <input type="number" name="cupo_maximo" id="cupo_maximo" required>
        <br>
        <input type="submit" value="Guardar">
    </form>
</div>