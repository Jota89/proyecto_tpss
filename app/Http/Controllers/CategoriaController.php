<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Rol;
use App\Models\Imagen;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorias = Categoria::get();
        //return $categorias ;
        //$currentUser = Auth::user();
        return view(
            'store.categorias',
            compact(
                'categorias'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categorias
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentUser = Auth::user();
        $producto = Producto::find($id);
        $imagenes = Imagen::where('producto_id', $id)->get();
        $categorias = Categoria::get();
        $roles = Rol::get();
        $ids = [];
        // Obenemos los ids de usuario de los proveedores
        foreach ($roles->toArray() as $rol) {
            if ($rol['role_id'] == 4) {
                $ids[] = $rol['model_id'];
            }
        }
        $proveedores = Proveedor::select('id', 'nombre')->whereIn('id', $ids)->get();

        return view(
            'admin.productos.show',
            compact(
                'currentUser',
                'producto',
                'imagenes',
                'categorias',
                'proveedores'
            )
        );
    }

    // Frontend
    public function showCategory($name)
    {
        $currentUser = Auth::user();
        $categoria = Categoria::where('nombre', ucfirst($name))->first();
        $categorias = Categoria::get();
        //print_r($categoria->toArray());die;
        $productos = Producto::where('categoria_id', $categoria->id)->get();
        //$imagenes = Imagen::where('producto_id', $productos->id)->get();
        $imagenes = [];
        $roles = Rol::get();
        $ids = [];
        // Obenemos los ids de usuario de los proveedores
        foreach ($roles->toArray() as $rol) {
            if ($rol['role_id'] == 4) {
                $ids[] = $rol['model_id'];
            }
        }
        //$proveedor = Proveedor::select('id', 'nombre')->whereIn('id', $ids)->get();

        // validar que el producto pertenezca a la categoria para poder regresar la vista si no un erroro que diga que el producto no pertenece a la categoria
        return view(
            'store.categoria',
            compact(
                'currentUser',
                'productos',
                'imagenes',
                'categoria',
                'categorias'
            )
        );
    }

    //showCategories
    public function showCategories()
    {
        $currentUser = Auth::user();
        $categorias = Categoria::get();
        //print_r($categoria->toArray());die;
        $productos = Producto::get();
        //$imagenes = Imagen::where('producto_id', $productos->id)->get();
        $imagenes = [];
        $roles = Rol::get();
        $ids = [];
        // Obenemos los ids de usuario de los proveedores
        foreach ($roles->toArray() as $rol) {
            if ($rol['role_id'] == 4) {
                $ids[] = $rol['model_id'];
            }
        }
        //$proveedor = Proveedor::select('id', 'nombre')->whereIn('id', $ids)->get();

        // validar que el producto pertenezca a la categoria para poder regresar la vista si no un erroro que diga que el producto no pertenece a la categoria
        return view(
            'store.categorias',
            compact(
                'currentUser',
                'productos',
                'imagenes',
                'categorias',
                //'proveedor'
            )
        );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categorias
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categorias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categorias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
