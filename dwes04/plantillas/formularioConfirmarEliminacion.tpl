<style>
    form {
        margin: 20px;
        font-size: large;
        font-weight: bold;
    }

    label {
        margin: 10px;
    }

    input {
        margin: 10px;
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

<div>
    <form action="index.php?accion=borrar_taller" method="post"><label for="confirmar">Marque la casilla de verificación
            para confirmar la eliminación</label><input type="hidden" name="id" value="{$id}">
        <input type="checkbox" id="eliminar" name="eliminar" value="eliminar">
        <br>
        <input type="submit" value="Confirmar elimninación">
    </form>
</div>