@extends("layout.plantilla")

@section('titulo', 'Lista de productos')

@section('contenido')
    @if(session('exito'))
        <div class="alert alert-success" role="alert">
            {{ session('exito') }}
        </div>

    @endif

    @if(session('fracaso'))
        <div class="alert alert-danger" role="alert">
            {{ session('fracaso') }}
        </div>
    @endif

    <h1>Lista de productos <a class="btn btn-primary" href="{{ route('productos.create') }}">Nuevo</a> </h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio de Compra</th>
            <th scope="col">Precio de Venta</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td><a href="{{ route('productos.show', ['id'=>$producto->id ]) }}">{{ $producto->codigo }}</a></td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio_compra }}</td>
                <td>{{ $producto->precio_venta }}</td>
                <td>
                    <a href="{{ route('productos.show', ['id' => $producto->id]) }}" class="btn btn-success btn-sm">Ver</a>
                    <a href="{{ route('productos.edit', ['id' => $producto->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                    <!-- Button trigger modal -->
                    <button type="button"  class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$producto->id}}">
                        Eliminar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalEliminar{{$producto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar {{ $producto->nombre }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿De verdad quiere eliminar el producto {{ $producto->nombre}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form method="post" action="{{ route('productos.destroy', ['id'=>$producto->id]) }}" class="form-inline">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Eliminar" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $productos->links() }}

@endsection
