<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        @include('layouts.sidebar') 

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-900">💰 CONTROL DE PAGOS / ABONOS</h1>
                <a href="{{ route('pagos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition text-sm">
                    ➕ REGISTRAR PAGO
                </a>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-800 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Folio Crédito</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Cliente</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Vehículo</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Método</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Monto Pagado</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                            @forelse($pagos as $pago)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-mono text-xs font-bold text-blue-600">#CR-{{ $pago->credito_id }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $pago->credito->cliente->nombre }} {{ $pago->credito->cliente->apellido }}</td>
                                    <td class="px-6 py-4 text-xs">{{ $pago->credito->automovil->marca }} {{ $pago->credito->automovil->modelo }}</td>
                                    <td class="px-6 py-4">{{ date('d/m/Y', strtotime($pago->fecha_pago)) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-slate-100 text-slate-800 px-2 py-0.5 rounded text-xs font-semibold">
                                            💳 {{ $pago->metodo_pago }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-green-600">${{ number_format($pago->monto, 2) }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" onsubmit="return confirm('¿Revertir este pago de caja?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-100 hover:bg-red-600 text-red-600 hover:text-white px-3 py-1 rounded transition text-xs font-semibold">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-gray-400 font-medium">No se han registrado abonos el día de hoy.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>