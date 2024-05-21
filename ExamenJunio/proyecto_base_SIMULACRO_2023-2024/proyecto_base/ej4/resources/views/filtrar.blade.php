<div>
    <h1>Formulario de Filtrado</h1>
    <form action="{{ route('filtrar') }}" method="POST">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <label for="anyo_lanzamiento">Año de lanzamiento:</label>
        <input type="number" name="anyo_lanzamiento" id="anyo_lanzamiento">
        <button type="submit">Filtrar</button>
    </form>
</div>
