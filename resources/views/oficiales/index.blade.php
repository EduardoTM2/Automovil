<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        @include('layouts.sidebar') 

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-900">🪪 OFICIALES DE CRÉDITO</h1>
                <a href="{{ route('oficiales.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition text-sm">
                    ➕ ASIGNAR OFICIAL
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
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Nombre del Oficial</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Departamento / Área</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Teléfono Interno</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                            @forelse($oficiales as $oficial)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">⚖️ {{ $oficial->nombre }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold text-slate-700 bg-slate-100 rounded-full">
                                            {{ $oficial->departamento ?? 'Riesgo / Crédito' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-xs">{{ $oficial->telefono ?? 'Sin Ext.' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ route('oficiales.destroy', $oficial->id) }}" method="POST" onsubmit="return confirm('¿Remover este oficial de crédito?')">
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
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 font-medium">No hay oficiales de crédito asignados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>