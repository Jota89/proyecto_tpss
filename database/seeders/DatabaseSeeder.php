<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // USUARIOS
        $users = [
            [
                'nombre'    =>  'Jeffer Montaño',
                'email'     =>  'admin@novaplus.com',
                'password'   =>  Hash::make('123456789'),
                'estado'    =>  '1',
            ],
            [
                'nombre'    =>  'Cliente Uno',
                'email'     =>  'cliente@novaplus.com',
                'password'   =>  Hash::make('123456789'),
                'estado'    =>  '1',
            ],
            [
                'nombre'    =>  'Empleado Uno',
                'email'     =>  'empleado@novaplus.com',
                'password'   =>  Hash::make('123456789'),
                'estado'    =>  '1',
            ],
            [
                'nombre'    =>  'Proveedor Uno',
                'email'     =>  'proveedor@novaplus.com',
                'password'   =>  Hash::make('123456789'),
                'estado'    =>  '1',
            ],
            [
                'nombre'    =>  'Empleado Dos',
                'email'     =>  'empleado2@novaplus.com',
                'password'   =>  Hash::make('123456789'),
                'estado'    =>  '1',
            ],
            [
                'nombre'    =>  'Empleado Tres',
                'email'     =>  'empleado3@novaplus.com',
                'password'   =>  Hash::make('123456789'),
                'estado'    =>  '1',
            ],
            [
                'nombre'    =>  'Movistar',
                'email'     =>  'movistar@novaplus.com',
                'password'   =>  Hash::make('123456789'),
                'estado'    =>  '1',
            ],
            [
                'nombre'    =>  'Claro',
                'email'     =>  'claro@novaplus.com',
                'password'   =>  Hash::make('123456789'),
                'estado'    =>  '1',
            ],
            [
                'nombre'    =>  'Tigo',
                'email'     =>  'tigo@novaplus.com',
                'password'   =>  Hash::make('123456789'),
                'estado'    =>  '1',
            ],
        ];
        DB::table('users')->insert($users);

        // ROLES
        $roles = [
            [
                'name'  =>  'admin',
                'guard_name' =>  'web',
            ],
            [
                'name'  =>  'cliente',
                'guard_name' =>  'web',
            ],
            [
                'name'  =>  'empleado',
                'guard_name' =>  'web',
            ],
            [
                'name'  =>  'proveedor',
                'guard_name' =>  'web',
            ]
        ];
        DB::table('roles')->insert($roles);

        $model_has_roles = [
            [
                'role_id'       =>  '1',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '1',
            ],
            [
                'role_id'       =>  '2',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '2',
            ],
            [
                'role_id'       =>  '3',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '3',
            ],
            [
                'role_id'       =>  '4',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '4',
            ],
            [
                'role_id'       =>  '3',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '5',
            ],
            [
                'role_id'       =>  '3',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '6',
            ],
            [
                'role_id'       =>  '4',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '7',
            ],
            [
                'role_id'       =>  '4',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '8',
            ],
            [
                'role_id'       =>  '4',
                'model_type'    =>  'App\Models\User',
                'model_id'      =>  '9',
            ],
        ];
        DB::table('model_has_roles')->insert($model_has_roles);

        // CATEGORIAS
        $categorias = [
            [
                'nombre' => 'Samsung',
                'descripcion' => 'Equipos de la marca Samsumg',
            ],
            [
                'nombre' => 'Iphone',
                'descripcion' => 'Equipos de la marca Apple',
            ],
            [
                'nombre' => 'Motorola',
                'descripcion' => 'Equipos de la marca Motorola',
            ]
        ];
        DB::table('categorias')->insert($categorias);

        // COLORES
        $colores = [
            ['nombre' => 'Blanco'],
            ['nombre' => 'Negro'],
            ['nombre' => 'Plateado'],
            ['nombre' => 'Dorado'],
            ['nombre' => 'Azul'],
            ['nombre' => 'Aguamarina'],
            ['nombre' => 'Verde'],
            ['nombre' => 'Morado'],
            ['nombre' => 'Beige'],
            ['nombre' => 'Rosado'],
        ];
        DB::table('colores')->insert($colores);

        // CAPACIDADES
        $capacidades = [
            ['nombre' => '256GB'],
            ['nombre' => '128GB'],
            ['nombre' => '100GB'],
        ];
        DB::table('capacidades')->insert($capacidades);

        // PRODUCTOS
        $productos = [
            [
                'codigo' => 001,
                'nombre' => 'Samsung Galaxy S22+',
                'descripcion' => 'Incluye un optimizador de escenas, reconocimiento automático de imágenes y encuadre profesional inteligente para ofrecerte la mejor configuración y encuadre para mejorar en gran medida tus fotos.',
                'precio' => 6000000,
                'descuento' => 6,
                'categoria_id' => 1,
                'proveedor_id' => 7,
                'stock' => 50,
                'estado' => 1,
            ],
            [
                'codigo' => 003,
                'nombre' => 'Iphone 80iPhone 13 Pro Max',
                'descripcion' => 'Un sistema de fotografía profesional mejorado como nunca antes. Una pantalla Super Retina XDR de 6.7 pulgadas con tecnología ProMotion para mayor velocidad y capacidad de respuesta. Y el chip Bionic A15 ultrarrápido.',
                'precio' => 6000000,
                'descuento' => 6,
                'categoria_id' => 2,
                'proveedor_id' => 8,
                'stock' => 50,
                'estado' => 1,
            ],
            [
                'codigo' => 004,
                'nombre' => 'Motorola Moto Edge 30 Pro 256GB',
                'descripcion' => 'Conoce el celular Motorola Edge 30 Pro 256GB y llevate gratis una Go Pro.',
                'precio' => 4800000,
                'descuento' => 10,
                'categoria_id' => 3,
                'proveedor_id' => 9,
                'stock' => 50,
                'estado' => 1,
            ]
        ];
        DB::table('productos')->insert($productos);

        $coloresProductos = [
            [
                'color_id'=>'1',
                'producto_id'=>'1',
            ],
            [
                'color_id'=>'2',
                'producto_id'=>'1',
            ],
            [
                'color_id'=>'3',
                'producto_id'=>'1',
            ],
            [
                'color_id'=>'4',
                'producto_id'=>'2',
            ],
            [
                'color_id'=>'5',
                'producto_id'=>'2',
            ],
            [
                'color_id'=>'6',
                'producto_id'=>'2',
            ],
            [
                'color_id'=>'7',
                'producto_id'=>'3',
            ],
            [
                'color_id'=>'8',
                'producto_id'=>'3',
            ],
            [
                'color_id'=>'9',
                'producto_id'=>'3',
            ],
        ];
        DB::table('colores_producto')->insert($coloresProductos);

        $capacidadesProductos = [
            [
                'capacidad_id'=>'1',
                'producto_id'=>'1',
            ],
            [
                'capacidad_id'=>'2',
                'producto_id'=>'2',
            ],
            [
                'capacidad_id'=>'3',
                'producto_id'=>'3',
            ],
        ];
        DB::table('capacidades_producto')->insert($capacidadesProductos);

        // ORDENES
        /* $estados_ordenes = [
            ['nombre'  => 'Borrador'],
            ['nombre'  => 'En Proceso'],
            ['nombre'  => 'Pendiente de Pago'],
            ['nombre'  => 'Cancelada'],
            ['nombre'  => 'Pagada'],
            ['nombre'  => 'Enviada'],
            ['nombre'  => 'Entregada'],
            ['nombre'  => 'Cotizacion']
        ];
        DB::table('estados_ordenes')->insert($estados_ordenes);

        $ordenes = [
            [
                'fecha' => '2022-07-02',
                'cliente_id' => '2',
                'metodo_pago' => '1',
                'impuestos' => '16',
                'subtotal' => '80000',
                'descuento' => '0',
                'total' => '10000',
                'empleado_id' => '3',
                'detalle_id' => '1',
                'estado_id' => '7',
            ]
        ];
        DB::table('ordenes')->insert($ordenes);

        $detalle_orden = [
            [
                'order_id'      => 1,
                'producto_id'   => 1,
                'cantidad'      => 1,
                'precio'        => 10000,
                'descuento'     => 0,
                'categoria_id'  => 1,
            ]
        ];
        DB::table('detalle_orden')->insert($detalle_orden); */
    }
}
