{if isset($errors)}
    <div style="color: red;">
        <ul>
            {foreach $errors as $error}
                <li>{$error}</li>
            {/foreach}
        </ul>
    </div>
{/if}
<form method="post" action="?accion=guardar_impresora">
    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="marca" ><br>

    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo" ><br>

    <label for="tipo">Tipo:</label>
    <select name="tipo" id="tipo">
        <option value="inyección de tinta" >Inyección de tinta</option>
        <option value="laser">Laser</option>
        <option value="matricial">Matricial</option>
    </select><br>
    
    <label for="color">Color:</label>
    <input type="radio" name="color" value="si"> Si
    <input type="radio" name="color" value="no"> No<br>
    
    <label for="year">Año:</label>
    <input type="text" id="year" name="year"><br>

    <label for="coste">Precio:</label>
    <input type="text" id="coste" name="coste"><br>

    <input type="submit" value="Guardar">
</form>