<?php

namespace App\Http\Controllers;

use App\Models\Cliente; 
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        // Trae todos los clientes de la base de datos
        $clientes = Cliente::all(); 
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'correo' => 'required|email|unique:clientes,correo',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', '¡Cliente registrado con éxito!');
    }

    public function edit($id)
    {
        // Buscamos el cliente por su ID para llenar el formulario de edición
        $cliente = Cliente::findOrFail($id);
        
        // Redireccionamos a la vista 'create' reutilizando la misma interfaz
        return view('clientes.create', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        // Validamos los datos modificados.
        // El '.' $id al final del unique evita que rebote el correo si el usuario no lo cambió.
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'correo' => 'required|email|unique:clientes,correo,' . $id,
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', '¡Cliente actualizado con éxito!');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado del sistema.');
    }
}