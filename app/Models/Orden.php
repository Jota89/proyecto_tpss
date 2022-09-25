<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ordenes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'referencia',
        'fecha',
        'cliente_id',
        'metodo_pago',
        'impuestos',
        'subtotal',
        'descuento',
        'total',
        'empleado_id',
        'detalle_id',
        'estado_id',
        'transaction_id',
        'direccion',
        'telefono',
        'ciudad',
        'depto',
        'email',
    ];
}
