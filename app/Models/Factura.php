<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    // Nombre exacto de tu tabla en SQLite
    protected $table = 'facturas';

    protected $fillable = [
        'credito_id',
        'folio_fiscal',
        'subtotal',
        'iva',
        'total',
    ];

    // Relación: Una factura pertenece a un Crédito específico
    public function credito()
    {
        return $this->belongsTo(Credito::class, 'credito_id');
    }
}