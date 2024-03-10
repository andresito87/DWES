@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/ubicaciones/store" method="post">
    @csrf
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="{{ !$errors->has('nombre') ? old('nombre') : '' }}"><br>
    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" value="{{ !$errors->has('descripcion') ? old('descripcion') : '' }}"><br>
    <label for="dias">Días en los que está disponible:</label>
    @foreach (['L', 'M', 'X', 'J', 'V', 'S', 'D'] as $dia)
        {{ $dia }} <input type="checkbox" name="dias[]"
            value="{{ $dia }}
        @if (is_array(old('dias')) && in_array($dia, old('dias'))) checked @endif">
    @endforeach
    <br>
    <input type="submit" value="Crear nueva ubicación">
</form>
