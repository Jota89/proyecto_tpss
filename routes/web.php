<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoFrontController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CategoriaFrontController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrdenController;
use App\Models\Rol;
use App\Models\Categoria;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//

Route::get('/', function () {
    //return view('store.home');
    $currentUser = Auth::user();
    return view(
        'store.home',
        compact(
            'currentUser'
        )
    );
})->name('home');
//
Auth::routes();
/* $roles = Rol::get();
//die($roles);
// Obenemos los ids de usuario de los empleados
foreach ($roles->toArray() as $rol) {
    if ($rol['role_id'] == '2') {
        //die('rol');
        return redirect('/');
    }
} */
// admin
//Route::group(['middleware' => ['role:admin','role:empleado','role:proveedor']], function () {
    //rutas accesibles solo para admin y empleados
    Route::get('admin', function () {
        $currentUser = Auth::user();
        return view(
            'admin.dashboard',
            compact(
                'currentUser'
            )
        );
    });
    
    Route::post('admin/productos/upload-image', [ProductoController::class, 'uploadImagen'])->name('productos.imagenUp');
    Route::delete('admin/productos/image-delete/{id}', [ProductoController::class, 'imagenDestroy'])->name('productos.imagenDel');

    Route::resource('admin/productos', ProductoController::class);
    Route::get('admin/producto/{id}', [ProductoController::class, 'show'])->name('producto');

    Route::resource('admin/empleados', EmpleadoController::class);
    Route::get('admin/empleado/{id}', [EmpleadoController::class, 'show'])->name('empleado');

    Route::resource('admin/usuarios', UsuarioController::class);
    Route::get('admin/usuario/{id}', [UsuarioController::class, 'show'])->name('usuario');

    Route::resource('admin/clientes', ClienteController::class);
    Route::get('admin/cliente/{id}', [ClienteController::class, 'show'])->name('cliente');

    Route::resource('admin/proveedores', ProveedorController::class);
    Route::get('admin/proveedor/{id}', [ProveedorController::class, 'show'])->name('proveedor');

    Route::resource('admin/categorias', CategoriaController::class);
    Route::get('admin/categoria/{id}', [CategoriaController::class, 'show'])->name('categoria');
//});
//
Route::get('mi-cuenta', function () {
    $currentUser = Auth::user();
    return view(
        'store.home',
        compact(
            'currentUser'
        )
    );
})->name('cuenta');
//
Route::get('mi-cuenta/ordenes', function () {
    $currentUser = Auth::user();
    return view(
        'store.home',
        compact(
            'currentUser'
        )
    );
})->name('ordenes');
// Tienda - Productos
Route::get('tienda', [CategoriaFrontController::class, 'showCategories'])->name('tienda');
Route::get('tienda/producto/{id}', [ProductoFrontController::class, 'showProduct'])->name('showProduct');
//
Route::get('tienda/categorias', [CategoriaFrontController::class, 'showCategories'])->name('showCategories');
Route::get('tienda/categoria/{name}', [CategoriaFrontController::class, 'showCategory'])->name('showCategory');
Route::get('tienda/categoria/{name}/producto/{id}', [ProductoFrontController::class, 'showCategoryProduct'])->name('showCategoryProduct');
//
// Carrito
Route::get('tienda/cart', [CartController::class, 'cart'])->name('cart');
Route::get('tienda/add-to-cart/{id}/{cant}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::patch('tienda/update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('tienda/remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');
Route::get('tienda/checkout', [CartController::class, 'checkout'])->name('checkout');
// Order
Route::post('tienda/checkout/ordenes/crear', [OrdenController::class, 'store'])->name('create.order');
Route::get('tienda/checkout/orden/{id}', [OrdenController::class, 'show'])->name('orden');
Route::get('tienda/checkout/orden/{id}/{status}', [OrdenController::class, 'status'])->name('orden.status');
// Search
//Route::get('/typeahead_autocomplete', [TypeaheadAutocompleteController::class, 'index']);
Route::get('autoComplete', [SearchController::class, 'autoComplete'])->name('autoComplete');
Route::get('search', [SearchController::class, 'search'])->name('search');
Route::get('filter', [SearchController::class, 'filter'])->name('filter');
