<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Credito;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FacturaController extends Controller
{
    public function index()
    {
        // Cargamos las facturas junto con la cadena de relaciones necesarias
        $facturas = Factura::with(['credito.cliente', 'credito.automovil'])->get();
        return view('facturas.index', compact('facturas'));
    }

    public function create()
    {
        // Listamos los créditos aprobados para poder facturarlos
        $creditos = Credito::with(['cliente', 'automovil'])->where('estado', 'Aprobado')->get();
        return view('facturas.create', compact('creditos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'credito_id' => 'required|exists:creditos,id|unique:facturas,credito_id',
        ]);

        // Buscamos el crédito para jalar el monto económico
        $credito = Credito::findOrFail($request->credito_id);

        // Cálculos financieros automáticos (Base IVA del 16%)
        $total = $credito->monto_financiado;
        $subtotal = $total / 1.16;
        $iva = $total - $subtotal;

        // Generamos un folio fiscal aleatorio único imitando un UUID para simular el SAT
        $folioFiscal = strtoupper(Str::random(8) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(12));

        Factura::create([
            'credito_id'   => $credito->id,
            'folio_fiscal' => $folioFiscal,
            'subtotal'     => $subtotal,
            'iva'          => $iva,
            'total'        => $total,
        ]);

        return redirect()->route('facturas.index')->with('success', '¡Factura Fiscal emitida correctamente!');
    }

    public function destroy($id)
    {
        $factura = Factura::findOrFail($id);
        $factura->delete();

        return redirect()->route('facturas.index')->with('success', 'Factura cancelada en el sistema.');
    }
}