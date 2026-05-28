<?php

namespace App\Http\Controllers;

use App\Models\OficialCredito;
use Illuminate\Http\Request;

class OficialCreditoController extends Controller 
{
    public function index() 
    { 
        return view('oficiales.index', ['oficiales' => OficialCredito::all()]); 
    }

    public function create() 
    { 
        return view('oficiales.create'); 
    }

    public function store(Request $request) 
    {
        // Validamos y guardamos los datos limpios de forma segura
        $data = $request->validate([
            'nombre'       => 'required|string', 
            'departamento' => 'required', 
            'telefono'     => 'nullable'
        ]);

        OficialCredito::create($data);

        return redirect()->route('oficiales.index')->with('success', 'Oficial de crédito asignado.');
    }

    public function destroy($id) 
    { 
        // Buscamos de forma segura por ID para que la ruta de Laravel responda de inmediato
        $oficial = OficialCredito::findOrFail($id); 
        $oficial->delete(); 

        return redirect()->route('oficiales.index')->with('success', 'Oficial removido de la sucursal.'); 
    }
}