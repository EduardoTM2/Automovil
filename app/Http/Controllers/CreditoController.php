<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Cliente;
use App\Models\Automovil;
use Illuminate\Http\Request;

class CreditoController extends Controller
{
    public function index()
    {
        // Cargamos los créditos junto con sus relaciones para no saturar la BD
        $creditos = Credito::with(['cliente', 'automovil'])->get();
        return view('creditos.index', compact('creditos'));
    }

    public function create()
    {
        // Necesitamos listarlos para ponerlos en selectores (dropdowns) en el formulario
        $clientes = Cliente::all();
        $automoviles = Automovil::all();
        return view('creditos.create', compact('clientes', 'automoviles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cliente_id'       => 'required|exists:clientes,id',
            'automovil_id'     => 'required|exists:automoviles,id',
            'monto_financiado' => 'required|numeric|min:0',
            'plazo_meses'      => 'required|integer|min:1',
            'estado'           => 'required|string',
        ]);

        Credito::create($data);

        return redirect()->route('creditos.index')->with('success', '¡Solicitud de crédito registrada con éxito!');
    }

    public function edit($id)
    {
        // Buscamos el crédito por su ID
        $credito = Credito::findOrFail($id);
        
        // También requerimos traer las listas para que el usuario pueda cambiar de cliente o auto si edita
        $clientes = Cliente::all();
        $automoviles = Automovil::all();
        
        // Redireccionamos a la vista 'create' unificada pasando todos los datos compactados
        return view('creditos.create', compact('credito', 'clientes', 'automoviles'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'cliente_id'       => 'required|exists:clientes,id',
            'automovil_id'     => 'required|exists:automoviles,id',
            'monto_financiado' => 'required|numeric|min:0',
            'plazo_meses'      => 'required|integer|min:1',
            'estado'           => 'required|string',
        ]);

        $credito = Credito::findOrFail($id);
        $credito->update($data);

        return redirect()->route('creditos.index')->with('success', '¡Información del crédito actualizada con éxito!');
    }

    public function destroy($id)
    {
        $credito = Credito::findOrFail($id);
        $credito->delete();

        return redirect()->route('creditos.index')->with('success', 'Crédito eliminado del sistema.');
    }
}