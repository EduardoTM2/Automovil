<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Automovil extends Model
{
    // Define el nombre exacto de la tabla en tu base de datos SQLite
    protected $table = 'automoviles';

    // Columnas que permitimos llenar mediante formularios (Mass Assignment)
    protected $fillable = [
        'marca',
        'modelo',
        'anio',
        'precio',
    ];
}
