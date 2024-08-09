@extends('layout.plantilla')
@section('titulo', 'Detalles de producto')
@section('contenido')
    <h1>Datos de {{ $producto->nombre }}</h1>
    <ul>
        <li><strong>ID:</strong> {{ $producto->id }}</li>
        <li><strong>Nombre:</strong> {{ $producto->nombre }}</li>
        <li><strong>Precio de Compra:</strong> {{ $producto->precio_compra }}</li>
        <li><strong>Precio de Venta:</strong> {{ $producto->precio_venta }}</li>
        <li><strong>Creado:</strong> {{ $producto->created_at->diffForHumans() }}</li>
        <li><strong>Ultima modificación :</strong> {{ $producto->updated_at->diffForHumans() }}</li>
        <li><strong>Proveedor :</strong> {{ $producto->proveedor->nombre }}</li>
    </ul>
@endsection
