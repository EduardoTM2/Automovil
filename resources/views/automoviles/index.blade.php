<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        @include('layouts.sidebar') 

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-900">🚘 STOCK DE AUTOMÓVILES</h1>
                <a href="{{ route('automoviles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition text-sm">
                    ➕ REGISTRAR UNIDAD
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
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Marca</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Modelo</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Año</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Precio Comercial</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                            @forelse($automoviles as $auto)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-bold text-gray-900">🚗 {{ $auto->marca }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $auto->modelo }}</td>
                                    <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs font-semibold">{{ $auto->anio }}</span></td>
                                    <td class="px-6 py-4 font-bold text-gray-900">${{ number_format($auto->precio, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('automoviles.edit', $auto->id) }}" class="bg-blue-100 hover:bg-blue-600 text-blue-600 hover:text-white px-3 py-1 rounded transition text-xs font-semibold shadow-sm">
                                                ✏️ Editar
                                            </a>

                                            <form action="{{ route('automoviles.destroy', $auto->id) }}" method="POST" onsubmit="return confirm('¿Retirar este automóvil del stock?')" class="inline m-0 p-0">
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
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 font-medium">No hay vehículos registrados en inventario.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>