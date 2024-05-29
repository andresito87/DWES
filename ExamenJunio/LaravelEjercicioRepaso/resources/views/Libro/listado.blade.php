@if ($errors->any())
    <h2>Errores</h2>
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<table>
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Año</th>
            <th>Autor</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($libros as $libro)
            <tr>
                <td>{{ $libro->titulo }}</td>
                <td>{{ $libro->year }}</td>
                <td>{{ $libro->autor }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
