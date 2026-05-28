<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    // Nombre exacto de tu tabla en la base de datos
    protected $table = 'creditos';

    // Columnas permitidas para llenado masivo
    protected $fillable = [
        'cliente_id',
        'automovil_id',
        'monto_financiado',
        'plazo_meses',
        'estado',
    ];

    // Relación: Un crédito pertenece a un Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relación: Un crédito pertenece a un Automóvil
    public function automovil()
    {
        return $this->belongsTo(Automovil::class, 'automovil_id');
    }
}