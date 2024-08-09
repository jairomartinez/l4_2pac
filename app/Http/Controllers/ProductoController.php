<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::paginate(10);

        return view('productos.index')->with("productos", $productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $provedores = Proveedor::all();
        return view('productos.formulario')->with('proveedores', $provedores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validar los datos del formulario.
        $request->validate([
            'codigo' => 'required|max:15|min:8|unique:productos,codigo',
            'nombre' => 'required|max:255|regex:/[a-zA-Z0-9 ]+/',
            'precio_compra'=>'required|numeric|min:0',
            'precio_venta' =>'required|numeric|min:0|gt:precio_compra',
            'proveedor_id'=> 'required|exists:proveedores,id'
        ]);

        // Crear un nuevo producto
        $producto = new Producto();

        // Asignamos los valores del producto.
        $producto->codigo = $request->input('codigo');
        $producto->nombre = $request->input('nombre');
        $producto->precio_compra = $request->input('precio_compra');
        $producto->precio_venta = $request->input('precio_venta');
        $producto->proveedor_id = $request->input('proveedor_id');

        // Save()
        if( $producto->save() ) {
            // mensaje de que todo salio bien
            return redirect()->route('productos.index')->with('exito', 'El producto se guardó exitosamente');

        } else {
            // mensaje de que no se logró guardar
            return redirect()->route('productos.index')->with('fracaso', 'El producto no se pudo guardar');

        }
        // Retornar al index y mostrar el mensaje de que se creó el producto.

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.unProducto')->with('producto', $producto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $proveedores = Proveedor::all();
        /**
         * Retornar la vista con el producto a modificar y la lista de proveedores para
         * llenar el select.
         */
        return view('productos.formulario', ['producto'=>$producto, 'proveedores'=>$proveedores]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /**
         * Validar los datos del formulario
         */
        $request->validate([
            'codigo' => 'required|max:15|min:8|unique:productos,codigo,'.$id,
            'nombre' => 'required|max:255|regex:/[a-zA-Z0-9 ]+/',
            'precio_compra'=>'required|numeric|min:0',
            'precio_venta' =>'required|numeric|min:0|gt:precio_compra',
            'proveedor_id'=> 'required|exists:proveedores,id'
        ]);


        $producto = Producto::findOrFail($id);

        // Asignamos los valores del producto.
        $producto->codigo = $request->input('codigo');
        $producto->nombre = $request->input('nombre');
        $producto->precio_compra = $request->input('precio_compra');
        $producto->precio_venta = $request->input('precio_venta');
        $producto->proveedor_id = $request->input('proveedor_id');

        // Save()
        if( $producto->save() ) {
            // mensaje de que todo salio bien
            return redirect()->route('productos.index')->with('exito', 'El producto se modificó exitosamente');

        } else {
            // mensaje de que no se logró guardar
            return redirect()->route('productos.index')->with('fracaso', 'El producto no se pudo editar');

        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eliminados = Producto::destroy($id);
        if($eliminados > 0) {
            return redirect()->route('productos.index')->with('exito', 'El producto se eliminó completamente');
        } else {
            return redirect()->route('productos.index')->with('fracaso', 'El producto no se pudo eliminar');
        }
    }
}
