<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    // Nombre exacto de tu tabla en SQLite
    protected $table = 'pagos';

    // Columnas permitidas para llenar formularios
    protected $fillable = [
        'credito_id',
        'monto',
        'fecha_pago',
        'metodo_pago',
    ];

    // Relación: Un pago pertenece a un Crédito
    public function credito()
    {
        return $this->belongsTo(Credito::class, 'credito_id');
    }
}