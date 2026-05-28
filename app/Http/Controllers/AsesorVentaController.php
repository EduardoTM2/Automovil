<?php

namespace App\Http\Controllers;

use App\Models\AsesorVenta;
use Illuminate\Http\Request;

class AsesorVentaController extends Controller 
{
    public function index() 
    { 
        return view('asesores.index', ['asesores' => AsesorVenta::all()]); 
    }

    public function create() 
    { 
        return view('asesores.create'); 
    }

    public function store(Request $request) 
    {
        // Validamos y guardamos los datos limpios
        $data = $request->validate([
            'nombre'   => 'required|string', 
            'telefono' => 'nullable', 
            'correo'   => 'required|email|unique:asesor_ventas,correo' // Cambiado al plural estándar de Laravel o pon el de tu migración
        ]);

        AsesorVenta::create($data);

        return redirect()->route('asesores.index')->with('success', 'Asesor agregado con éxito.');
    }

    public function destroy($id) 
    { 
        // Buscamos de forma segura por ID para evitar conflictos de nombres con la ruta
        $asesor = AsesorVenta::findOrFail($id); 
        $asesor->delete(); 

        return redirect()->route('asesores.index')->with('success', 'Asesor eliminado correctamente.'); 
    }
}