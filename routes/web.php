<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Rutas para los productos.
 */
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos/crear', [ProductoController::class, 'store'])->name('productos.store');

    Route::get('/productos/{id}/ver', [ProductoController::class, 'show'])->name('productos.show')->whereNumber('id');

    Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('productos.edit')->whereNumber('id');
    Route::put('/productos/{id}/editar', [ProductoController::class, 'update'])->name('productos.update')->whereNumber('id');
    Route::delete('/productos/{id}/eliminar', [ProductoController::class, 'destroy'])->name('productos.destroy')->whereNumber('id');
});

require __DIR__.'/auth.php';
