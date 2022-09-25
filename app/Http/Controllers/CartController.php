<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Imagen;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
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
     * Write code on Method
     *
     * @return response()
    */
    public function cart()
    {
        $productos = Producto::get();
        $currentUser = Auth::user();
        //return view('store.cart');
        return view(
            'store.cart',
            compact(
                'productos',
                'currentUser'
            )
        );
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id, $cant)
    {
        $product = Producto::findOrFail($id);
        $imagenes = Imagen::where('producto_id', $id)->get();
        $product->imagen = $imagenes->toArray()[0];

        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity']+=$cant;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->nombre,
                "quantity" => $cant,
                "price" => $product->precio,
                "image" => $product->imagen,
                "descuento" => $product->descuento,
                "categoria_id" => $product->categoria_id,
            ];
        }

        session()->put('cart', $cart);
        session()->put('status', 'BORRADOR');
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->put('status', 'BORRADOR');
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
                session()->put('status', 'BORRADOR');
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $cart =  session('cart');
        $currentUser = Auth::user();
        if ($cart) {
            return view(
                'store.checkout',
                compact('currentUser')
            );
        } else {
            return redirect()->route('tienda');
        }
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
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
