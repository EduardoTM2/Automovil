<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OficialCredito extends Model {
    protected $table = 'oficiales_credito';
    protected $fillable = ['nombre', 'departamento', 'telefono'];
}