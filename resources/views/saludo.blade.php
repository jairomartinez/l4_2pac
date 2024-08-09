@extends("layout.plantilla")

@section("contenido")
    @if($edad >40)
        <h1>Buenas tardes {{ $nombre }}</h1>
    @else
        <h1>Hola {{$nombre}}</h1>
    @endif
@endsection
