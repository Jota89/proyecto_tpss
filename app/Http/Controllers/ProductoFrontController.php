<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Rol;
use App\Models\Imagen;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ProductoFrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showProduct($id)
    {
        $currentUser = Auth::user();
        $producto = Producto::find($id);
        $imagenes = Imagen::where('producto_id', $id)->get();
        $producto->imagen = $imagenes->toArray()[0];
        $producto->galeria = $imagenes;


        $categorias = Categoria::get();
        $categoria = Categoria::find($producto->categoria_id);
        $roles = Rol::get();
        $ids = [];
        // Obenemos los ids de usuario de los proveedores
        foreach ($roles->toArray() as $rol) {
            if ($rol['role_id'] == 4) {
                $ids[] = $rol['model_id'];
            }
        }
        $proveedores = Proveedor::select('id', 'nombre')->whereIn('id', $ids)->get();

        // validar que el producto pertenezca a la categoria para poder regresar la vista si no un erroro que diga que el producto no pertenece a la categoria
        return view(
            'store.producto',
            compact(
                'currentUser',
                'producto',
                'imagenes',
                'categorias',
                'categoria',
                'proveedores'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCategoryProduct($name, $id)
    {
        $currentUser = Auth::user();
        $producto = Producto::find($id);
        $imagenes = Imagen::where('producto_id', $id)->get();
        $producto->imagen = $imagenes->toArray()[0];
        $producto->galeria = $imagenes;
        $categorias = Categoria::get();
        $categoria = Categoria::where('nombre', ucfirst($name))->first();
        $roles = Rol::get();
        $ids = [];
        // Obenemos los ids de usuario de los proveedores
        foreach ($roles->toArray() as $rol) {
            if ($rol['role_id'] == 4) {
                $ids[] = $rol['model_id'];
            }
        }
        $proveedores = Proveedor::select('id', 'nombre')->whereIn('id', $ids)->get();

        // validar que el producto pertenezca a la categoria para poder regresar la vista si no un erroro que diga que el producto no pertenece a la categoria
        return view(
            'store.producto',
            compact(
                'currentUser',
                'producto',
                'imagenes',
                'categorias',
                'categoria',
                'proveedores'
            )
        );
    }
}
