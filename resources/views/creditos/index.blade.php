<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        @include('layouts.sidebar') 

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-900">💳 CONTROL DE CRÉDITOS</h1>
                <a href="{{ route('creditos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition text-sm">
                    ➕ SOLICITAR CRÉDITO
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
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Cliente</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Vehículo</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Monto Financiado</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Plazo</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Estado</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                            @forelse($creditos as $credito)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- Relación Cliente --}}
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $credito->cliente ? $credito->cliente->nombre . ' ' . $credito->cliente->apellido : 'N/A' }}
                                    </td>
                                    {{-- Relación Automóvil --}}
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $credito->automovil ? $credito->automovil->marca . ' ' . $credito->automovil->modelo : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900">
                                        ${{ number_format($credito->monto_financiado, 2) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-gray-100 text-gray-800 px-2 py-0.5 rounded text-xs font-semibold">
                                            {{ $credito->plazo_meses }} meses
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if(strtolower($credito->estado) == 'aprobado')
                                            <span class="bg-green-100 text-green-800 px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Aprobado</span>
                                        @elseif(strtolower($credito->estado) == 'pendiente')
                                            <span class="bg-yellow-100 text-yellow-800 px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Pendiente</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider">{{ $credito->estado }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('creditos.edit', $credito->id) }}" class="bg-blue-100 hover:bg-blue-600 text-blue-600 hover:text-white px-3 py-1 rounded transition text-xs font-semibold shadow-sm">
                                                ✏️ Editar
                                            </a>

                                            <form action="{{ route('creditos.destroy', $credito->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar permanentemente este registro de crédito?')" class="inline m-0 p-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-100 hover:bg-red-600 text-red-600 hover:text-white px-3 py-1 rounded transition text-xs font-semibold shadow-sm">
                                                    🗑️ Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-400 font-medium">No hay solicitudes de crédito registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>