<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolaController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', [HolaController::class, "index"]);
Route::get('/hola/{nombre}/{edad}', [HolaController::class, "conNombre"])->whereAlpha("nombre");

/**
 * Rutas para los productos.
 */
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos/crear', [ProductoController::class, 'store'])->name('productos.store');

Route::get('/productos/{id}/ver', [ProductoController::class, 'show'])->name('productos.show')->whereNumber('id');

Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit')->whereNumber('id');
Route::put('/productos/{id}/editar', [ProductoController::class, 'update'])->name('productos.update')->whereNumber('id');
Route::delete('/productos/{id}/eliminar', [ProductoController::class, 'destroy'])->name('productos.destroy')->whereNumber('id');

