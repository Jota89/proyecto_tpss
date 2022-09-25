<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Roles;
use Illuminate\Http\Request;

class SearchController extends Controller
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
     * autoComplete
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autoComplete(Request $request)
    {
        $data = $request->all();
        $query = $data['query'];
        $response = Producto::select('nombre')->where('nombre', 'LIKE', "%{$query}%")->pluck('nombre');
        return response()->json($response);
    }

    /**
     * Search
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $data = $request->all();
        $query = $data['query'];
        $response = Producto::select('id')->where('nombre', 'LIKE', "%{$query}%")->pluck('id');
        return response()->json($response);
    }

    /**
     * Search
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $data = $request->all();
        $query = $data['query'];
        //print_r($query);
        if($query!=null){
            //print_r($query);
            $response = Producto::select('id')->whereIn('categoria_id', $query)->pluck('id');
        } else{
            $response = Producto::select('id')->pluck('id');
        }
        return response()->json($response);
    }
}
