<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Credito;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index()
    {
        // Traemos los pagos cargando la relación de créditos, clientes y autos de un jalón
        $pagos = Pago::with(['credito.cliente', 'credito.automovil'])->get();
        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        // Solo necesitamos listar los créditos que estén 'Aprobados' para recibirles pago
        $creditos = Credito::with(['cliente', 'automovil'])->where('estado', 'Aprobado')->get();
        return view('pagos.create', compact('creditos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'credito_id'  => 'required|exists:creditos,id',
            'monto'       => 'required|numeric|min:1',
            'fecha_pago'  => 'required|date',
            'metodo_pago' => 'required|string',
        ]);

        Pago::create($data);

        return redirect()->route('pagos.index')->with('success', '¡Abono registrado con éxito en caja!');
    }

    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->delete();

        return redirect()->route('pagos.index')->with('success', 'Registro de pago cancelado.');
    }
}