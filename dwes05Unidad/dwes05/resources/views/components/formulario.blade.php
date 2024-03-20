<form action="{{ $action }}" method="POST">
    @csrf
    <h2>{{ $titulo }}</h2>
    <div class="campos">
        {{ $campos }}
    </div>
    <div class="boton">
        {{ $boton }}
    </div>
</form>
