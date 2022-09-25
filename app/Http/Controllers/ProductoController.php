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

class ProductoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'codigo' => ['required', 'string', 'max:111'],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion'  =>  ['required', 'string', 'max:255'],
            'precio' => ['required'],
            'descuento' => ['string'],
            'categoria_id' => ['required'],
            'proveedor_id' => ['required'],
            'stock' => ['required'],
            'imagen' => 'required|image|mimes:jpg,png,jpeg|max:60',
            //'galeria' => ['string'],
            'estado'    =>  ['required'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentUser = Auth::user();
        // Obtenemos los productos y los proveedores
        $productos = Producto::get();
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
        // Validamos el Request para crear la tabla
        if ($request->ajax()) {
            $allData = DataTables::of($productos)
            ->addIndexColumn()
            ->editColumn('categoria_id', function ($row) {
                $id = $row->categoria_id;
                $categorias = Categoria::get();
                foreach ($categorias as $item) {
                    if ($id==$item->id) {
                        $return = $item->nombre;
                    }
                }
                return $return;
            })
            ->editColumn('proveedor_id', function ($row) {
                $id = $row->proveedor_id;
                $roles = Rol::get();
                $ids = [];
                // Obenemos los ids de usuario de los proveedores
                foreach ($roles->toArray() as $rol) {
                    if ($rol['role_id'] == 4) {
                        $ids[] = $rol['model_id'];
                    }
                }
                $proveedores = Proveedor::select('id', 'nombre')->whereIn('id', $ids)->get();
                $return = "";
                foreach ($proveedores as $item) {
                    if ($id==$item->id) {
                        $return = $item->nombre;
                    }
                }
                return $return;
            })
            ->editColumn('estado', function ($row) {
                $estado = $row->estado;
                if ($estado==1) {
                    $estado = "Activo";
                } elseif ($estado==0) {
                    $estado = "Inactivo";
                }
                return $estado;
            })
            ->addColumn('accciones', function ($row) {
                $btn = '<div class="d-flex justify-content-evenly"><a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Editar" id="editProducto" class="edit btn btn-sm" style="text-align: center;width: 50px; margin:0 auto; cursor:pointer; display: block;"><i class="far fa-edit"></i></a>  <a href="/admin/producto/'.$row->id.'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Ver" id="" class="ver btn btn-sm" style="text-align: center;width: 50px; margin:0 auto; cursor:pointer; display: block;"><i class="far fa-eye"></i> </a>  <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Borrar" id="deleteProducto" class="delete btn btn-sm" style="text-align: center;width: 50px; margin:0 auto; cursor:pointer; display: block;"><i class="far fa-trash-alt"></i> </a></div>';
                return $btn;
            })
            ->rawColumns(['accciones'])
            ->make(true);

            return $allData;
        }
        //
        return view(
            'admin.productos.index',
            compact(
                'currentUser',
                'productos',
                'proveedores',
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r($request->file('imagen')); die;
        //return json_encode($request->file('imagen'));
        if ($request->ajax()) {
            //
            //
            $producto = Producto::create(
                [
                    'codigo'    => $request['codigo'],
                    'nombre'    => $request['nombre'],
                    'descripcion'  => $request['descripcion'],
                    'precio'    => $request['precio'],
                    'descuento' => $request['descuento'],
                    'categoria_id'  => $request['categoria'],
                    'proveedor_id'  => $request['proveedor'],
                    'stock'     => $request['stock'],
                    'imagen'    =>  '',
                    'galeria'   => $request['galeria'],
                    'estado'    => $request['estado'],
                ],
            );
            //
            
            if ($request['imagen']!='' || $request['imagen']!=null) {
                $image = $request['imagen'];
                $name = $request->file('imagen')->getClientOriginalName();
                $path = 'img/productos';
                $filename = $request['nombre'].'_'.$producto->id.'_'.$name;
                $image->move(public_path($path), $filename);
                $imagen = Imagen::create(
                    [
                        'name'  =>  $filename,
                        'path'  =>  $path,
                        'producto_id'   => $producto->id,
                    ]
                );
                $p = Producto::find($producto->id);
                $p->imagen = $imagen->id;
                $p->save();
            }
        }
        return response()->json(['success'=>'Producto creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto $id
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

    public function showProduct($id)
    {
        $currentUser = Auth::user();
        $producto = Producto::find($id);
        $imagenes = Imagen::where('producto_id', $id)->get();
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

    public function showCategoryProduct($name,$id)
    {
        $currentUser = Auth::user();
        $producto = Producto::find($id);
        $imagenes = Imagen::where('producto_id', $id)->get();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        //$empleados = User::select('id', 'nombre', 'apellido', 'documento', 'telefono', 'email')->whereIn('id', $ids)->get();

        $datos = [
            'producto'=>$producto,
            //'roles'=>$roles
        ];
        return response()->json($datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->ajax()) {
            if ($request['imagen']=='' || $request['imagen']==undefined || $request['imagen']==[] || $request['imagen']==null) {
                $id = $request['id'];
                $producto = Producto::find($id);
                $producto->codigo = $request['codigo'];
                $producto->nombre = $request['nombre'];
                $producto->descripcion  = $request['descripcion'];
                $producto->precio  = $request['precio'];
                $producto->descuento = $request['descuento'];
                $producto->categoria_id  = $request['categoria'];
                $producto->proveedor_id   = $request['proveedor'];
                $producto->stock = $request['stock'];
                //$producto->imagen   = $request['imagen'];
                //$producto->galeria  = $request['galeria'];
                $producto->estado    = $request['estado'];
                $producto->save();
            } else {
                $image = json_decode($request['imagen']);
                $name = $request->file('imagen')->getClientOriginalName();
                $path = 'img/productos';
                $filename = $request['nombre'].'_'.$producto->id.'_'.$name;
                $image->move(public_path($path), $filename);
                $imagen = Imagen::create(
                    [
                        'name'  =>  $filename,
                        'path'  =>  $path,
                        'producto_id'   => $producto->id,
                    ]
                );
            }
        }
        return response()->json(['success'=>'Producto actualizado correctamente']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function uploadImagen(Request $request)
    {
        $id = $request['id'];
        $image = $request->file('imagen');
        $name = $image->getClientOriginalName();
        $path = 'img/productos';
        $filename =  str_replace(" ","_",$request['nombreP'].'_'.$id.'_'.$name);
        $image->move(public_path($path), $filename);
        $imagen = Imagen::create(
            [
                'name'  =>  $filename,
                'path'  =>  $path,
                'producto_id'   => $id,
            ]
        );

        //
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

        //return redirect('admin/producto/'.$id);
        return back()->with("success", __("¡Imagen Agregada!"));

        /* return view(
            'admin.productos.show',
            compact(
                'currentUser',
                'producto',
                'imagenes',
                'categorias',
                'proveedores'
            )
        ); */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Imgen $imagen
     * @return \Illuminate\Http\Response
     */
    public function imagenDestroy($id)
    {
        $imagen = Imagen::find($id);
        unlink($imagen->path."/".$imagen->name);
        $imagen->delete();

        return back()->with("success", __("¡Imagen eliminado!"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::find($id)->delete();
        return response()->json(['success'=>'Producto eliminado correctamente']);
    }
}
