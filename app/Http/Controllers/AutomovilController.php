<?php

namespace App\Http\Controllers;

use App\Models\Automovil; // Tu modelo Automovil
use Illuminate\Http\Request;

class AutomovilController extends Controller
{
    public function index()
    {
        $automoviles = Automovil::all();
        return view('automoviles.index', compact('automoviles'));
    }

    public function create()
    {
        return view('automoviles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'required|integer',
            'precio' => 'required|numeric',
        ]);

        Automovil::create($request->all());

        return redirect()->route('automoviles.index')->with('success', '¡Automóvil agregado al inventario!');
    }

    public function edit($id)
    {
        // Buscamos el auto por su ID para mandarlo al formulario
        $automovil = Automovil::findOrFail($id);
        
        // Redireccionamos a la vista 'create' reutilizando la misma interfaz
        return view('automoviles.create', compact('automovil'));
    }

    public function update(Request $request, $id)
    {
        // Validamos que los datos editados cumplan con las reglas de negocio
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'required|integer',
            'precio' => 'required|numeric',
        ]);

        $auto = Automovil::findOrFail($id);
        $auto->update($request->all());

        return redirect()->route('automoviles.index')->with('success', '¡Información del vehículo actualizada con éxito!');
    }

    public function destroy($id)
    {
        $auto = Automovil::findOrFail($id);
        $auto->delete();

        return redirect()->route('automoviles.index')->with('success', 'Vehículo removido del stock.');
    }
}