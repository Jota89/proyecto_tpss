<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Orden;
use App\Models\DetalleOrden;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Http;

class OrdenController extends Controller
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
           /*  'nombre' => ['required', 'string', 'max:255'],
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
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            'estado'    =>  ['required'], */
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $currentUser = Auth::user();
        //si no hay usuario toca crearlo e iniciar session
        if (!$currentUser) {
            //dd($request);
            $password =  Hash::make($request['documento']); //generar con la cedula
            $newUser = User::create(
                [
                    'nombre'    => $request['firstName'],
                    'apellido'  => $request['lastName'],
                    'tipo_doc'  => $request['tipo_doc'],
                    'documento' => $request['documento'],
                    'direccion' => $request['address'],
                    'ciudad'    => $request['ciudad'],
                    'departamento'  => $request['depto'],
                    'telefono'  => $request['telefono'],
                    'email'     => $request['email'],
                    'password'  => $password,
                    'estado'    => 1,
                ],
            );
            $newUser->assignRole('cliente');
            $post = array('password' => $password, 'email' => $request['email']);
            Auth::loginUsingId($newUser->id);
            $currentUser = Auth::user();
        }
        //dd($newUser);

        //dd(session());
        $cart =  session('cart');
        $total = 0;
        foreach (session('cart') as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $referencia = substr(str_shuffle($permitted_chars), 0, 10).time();
        // si el usuario existe hay que crear la orden
        $orden = Orden::create(
            [
                'referencia'    => $referencia,
                'fecha'         => now(),
                'cliente_id'    => $currentUser->id,
                'metodo_pago'   => 1, // $request['paymentMethod'],
                'impuestos'     => 0,
                'subtotal'      => $total,
                'descuento'     => 0,
                'total'         => $total,
                'empleado_id'   => null,
                'detalle_id'    => 0,
                'estado_id'     => 1, // Al crear la orden se deja como borrador
                'transaction_id'    => 0,
                'direccion'     => $request['address'],
                'telefono'      => $request['telefono'],
                'ciudad'        => $request['ciudad'],
                'depto'         => $request['depto'],
                'email'         => $request['email'],
            ],
        );
        // luego de crear la orden hay que crear el detalle  iterando cada producto
        foreach ($cart as $item) {
            $detalleOrden = DetalleOrden::create([
                'order_id'      => $orden->id,
                'producto_id'   => $item['id'],
                'cantidad'      => $item['quantity'],
                'precio'        => $item['price'],
                'descuento'     => $item['descuento'],
                'categoria_id'  => 0,
            ]);
        }
        // al agregarle los productos se pasa a pendiente de pagos
        $orden->estado_id = 3;
        $orden->save();
        session()->put('status', 'PENDIENTE');
        session()->put('order', $orden->toArray());

        //dd($orden);
        //dd($detalleOrden);

        // agregar al detalle el nombre del producto

        // se debe redirigir a una ventana con la orden y un boton para pagar

        return redirect()->route('orden', ['id' => $orden->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (session('status')=='') {
            return redirect()->route('home');
        }
        // validar si hay un parametro en la url con el transaction_id.
        // Ej:
        // http://novaplus14.com/tienda/orden/18?id=123068-1662228546-38459&env=test
        //  $transaction_id = $_GET['id'];

        if (count($_GET)>0) {
            $transaction_id = $_GET['id'];
            if ($transaction_id) {
                // Obtener el estado de la transacion desde la api de wompi
                // https://sandbox.wompi.co/v1/transactions/transaction_id
                // https://production.wompi.co/v1/transactions/transaction_id
                $getTransaction = Http::get('https://sandbox.wompi.co/v1/transactions/'.$transaction_id);
                //dd(json_decode($response->body()));
                $transaction = json_decode($getTransaction->body());
                //dd($response->data->status);
                $status = $transaction->data->status;
                switch ($status) {
                    case 'APPROVED':
                        $estado = 9;
                        session()->put('status', $status);
                        break;
                    case 'DECLINED':
                        $estado = 10;
                        session()->put('status', $status);
                        break;
                    case 'VOIDED':
                        $estado = 11;
                        session()->put('status', $status);
                        break;
                    case 'ERROR':
                        $estado = 12;
                        session()->put('status', $status);
                        break;
                    default:
                        break;
                }

                $orden = Orden::find($id);
                $orden->transaction_id = $transaction_id;
                $orden->estado_id = $estado;
                $orden->save();
                $cliente = Cliente::select('nombre', 'apellido', 'documento')->where('id', $orden->cliente_id)->get()->first();
                $orden->nombreCliente = $cliente->nombre." ".$cliente->apellido;
                $orden->docCliente = $cliente->documento;
                session()->put('order', $orden);
                //dd($orden);
                return redirect()->route('orden.status', [$id,$status]);
            }
        }

        $cart =  session('cart');
        $currentUser = Auth::user();
        $orden = Orden::find($id);
        // pegarle a la orden los datos del usuario
        $cliente = Cliente::select('nombre', 'apellido', 'documento')->where('id', $orden->cliente_id)->get()->first();
        $orden->nombreCliente = $cliente->nombre." ".$cliente->apellido;
        $orden->docCliente = $cliente->documento;

        //dd($orden);

        $detalleOrden = DetalleOrden::where('order_id', $id)->get();
        // pegarle al detalle el nombre del producto
        foreach ($detalleOrden as $item) {
            $nombreProducto = Producto::select('nombre')->where('id', $item->producto_id)->get()->first();
            $item->nombreProducto = $nombreProducto->nombre;
        }
        session()->put('order', $orden);
        //
        if ($orden) {
            $transaction = null;
            return view(
                'store.orden',
                compact(
                    'currentUser',
                    'orden',
                    'detalleOrden',
                    'transaction'
                )
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function status($id, $status)
    {
        //dd(session('status'));

        $cart =  session('cart');
        if (session('status')=='') {
            return redirect()->route('home');
        }

        //dd($id);
        $currentUser = Auth::user();
        $orden = Orden::find($id);
        $getTransaction = Http::get('https://sandbox.wompi.co/v1/transactions/'.$orden->transaction_id);
        $transaction = json_decode($getTransaction->body());
        $transaction = $transaction->data;
        // pegarle a la orden los datos del usuario
        $cliente = Cliente::select('nombre', 'apellido', 'documento')->where('id', $orden->cliente_id)->get()->first();
        $orden->nombreCliente = $cliente->nombre." ".$cliente->apellido;
        $orden->docCliente = $cliente->documento;

        //dd($orden);

        $detalleOrden = DetalleOrden::where('order_id', $id)->get();
        // pegarle al detalle el nombre del producto
        foreach ($detalleOrden as $item) {
            $nombreProducto = Producto::select('nombre')->where('id', $item->producto_id)->get()->first();
            $item->nombreProducto = $nombreProducto->nombre;
        }
        //
        if($transaction->status == 'APPROVED'){
            session()->put('cart', []);
        }
        
        
        return view(
            'store.orden',
            compact(
                'currentUser',
                'orden',
                'detalleOrden',
                'transaction'
            )
        );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $rol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rol $rol)
    {
        //
    }
}
