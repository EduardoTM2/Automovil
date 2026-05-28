<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        @include('layouts.sidebar') 

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-900">👥 CONTROL DE CLIENTES</h1>
                <a href="{{ route('clientes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition text-sm">
                    ➕ REGISTRAR CLIENTE
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
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Nombre Completo</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Dirección</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Teléfono</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Correo</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                            @forelse($clientes as $cliente)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
                                    <td class="px-6 py-4">{{ $cliente->direccion }}</td>
                                    <td class="px-6 py-4">{{ $cliente->telefono }}</td>
                                    <td class="px-6 py-4 font-mono text-xs text-blue-600">{{ $cliente->correo }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="bg-blue-100 hover:bg-blue-600 text-blue-600 hover:text-white px-3 py-1 rounded transition text-xs font-semibold shadow-sm">
                                                ✏️ Editar
                                            </a>

                                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar permanentemente a este cliente?')" class="inline m-0">
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
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 font-medium">No hay clientes registrados en la base de datos.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>