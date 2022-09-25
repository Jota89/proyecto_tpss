<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;

class ProveedorController extends Controller
{
    use RegistersUsers, HasRoles;

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
            'nombre' => ['required', 'string', 'max:255'],
            'apellido'  =>  ['required', 'string', 'max:255'],
            'tipo_doc'  =>  ['required', 'string', 'max:5'],
            'documento'     =>  ['required', 'string', 'max:20'],
            'fecha_nacimiento'  =>  'date',
            'sexo'  =>  ['required'],
            'direccion' =>  ['required', 'string', 'max:255'],
            'ciudad'    =>  ['required', 'string', 'max:255'],
            'departamento'  =>  ['required', 'string', 'max:255'],
            'telefono'  =>  ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        //
        $roles = Rol::get();
        $ids = [];

        // Obenemos los ids de usuario de los proveedores
        foreach ($roles->toArray() as $rol) {
            if ($rol['role_id'] == 4) {
                $ids[] = $rol['model_id'];
            }
        }

        // Obtenemos solo los proveedores de la tabla usuario
        $proveedores = User::select('id', 'nombre', 'apellido', 'documento', 'telefono', 'email', 'estado')->whereIn('id', $ids)->get();

        // Validamos el Request para crear la tabla
        if ($request->ajax()) {
            $allData = DataTables::of($proveedores)
            ->addIndexColumn()
            ->editColumn('estado', function ($row) {
                $estado = $row->estado;
                if ($estado==1) {
                    $estado = "Activo";
                } elseif ($estado==0) {
                    $estado = "Inactivo";
                }
                
                return $estado;
            })
            ->addColumn('acciones', function ($row) {
                $btn = '<div class="d-flex justify-content-evenly"><a href"javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Editar" id="editProveedor" class="edit btn btn-sm" style="text-align: center;width: 50px; margin:0 auto; cursor:pointer; display: block;"><i class="far fa-edit"></i></a> <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Borrar" id="deleteProveedor" class="delete btn btn-sm" style="text-align: center;width: 50px; margin:0 auto; cursor:pointer; display: block;"><i class="far fa-trash-alt"></i> </a></div>';
                return $btn;
            })
            ->rawColumns(['acciones'])
            ->make(true);

            return $allData;
        }

        
        $today = date('Y-m-d');
        $fecha = explode("-", $today);
        $max = ($fecha[0]-18).'-'.$fecha[1].'-'.$fecha[2];

        return view(
            'admin.proveedores.index',
            compact(
                'currentUser',
                'proveedores',
                'roles',
                'max',
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
        if ($request->ajax()) {
            $proveedor = User::create(
                [
                    'nombre'    => $request['nombre'],
                    'apellido'  => $request['apellido'],
                    'tipo_doc'  => $request['tipo_doc'],
                    'documento' => $request['documento'],
                    'fecha_nacimiento'  => $request['fecha_nacimiento'],
                    'sexo'      => $request['sexo'],
                    'direccion' => $request['direccion'],
                    'ciudad'    => $request['ciudad'],
                    'departamento'  => $request['departamento'],
                    'telefono'  => $request['telefono'],
                    'email'     => $request['email'],
                    'password'  => Hash::make($request['password']),
                    'estado'    => $request['estado'],
                ],
            );

            $proveedor->assignRole('proveedor');
        }
        return response()->json(['success'=>'proveedor creado correctamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(User $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor = User::find($id);
        //$proveedores = User::select('id', 'nombre', 'apellido', 'documento', 'telefono', 'email')->whereIn('id', $ids)->get();

        $datos = [
            'proveedor'=>$proveedor,
            //'roles'=>$roles
        ];
        return response()->json($datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $proveedor)
    {
        if ($request->ajax()) {
            $id = $request['id'];
            $user = User::find($id);
            $user->nombre    = $request['nombre'];
            $user->apellido  = $request['apellido'];
            $user->tipo_doc  = $request['tipo_doc'];
            $user->documento = $request['documento'];
            $user->fecha_nacimiento  = $request['fecha_nacimiento'];
            $user->sexo      = $request['sexo'];
            $user->direccion = $request['direccion'];
            $user->ciudad    = $request['ciudad'];
            $user->departamento  = $request['departamento'];
            $user->telefono  = $request['telefono'];
            $user->email     = $request['email'];
            $user->password  = Hash::make($request['password']);
            $user->estado    = $request['estado'];
            $user->save();
        }
        return response()->json(['success'=>'Proveedor actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['success'=>'Proveedor eliminado correctamente']);
    }
}
