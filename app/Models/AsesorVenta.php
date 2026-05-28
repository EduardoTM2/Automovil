<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class AsesorVenta extends Model {
    protected $table = 'asesores_ventas';
    protected $fillable = ['nombre', 'telefono', 'correo'];
}