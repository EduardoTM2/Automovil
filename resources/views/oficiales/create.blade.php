<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow px-6 py-4">
                <h1 class="text-2xl font-bold text-blue-900">📝 ALTA DE OFICIAL DE CRÉDITO</h1>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <div class="max-w-2xl bg-white rounded-lg shadow p-6">
                    <form action="{{ route('oficiales.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre Completo *</label>
                            <input type="text" name="nombre" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Departamento / Sucursal *</label>
                            <input type="text" name="departamento" required placeholder="Ej: Mesa de Control, Análisis de Riesgo" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono o Extensión</label>
                            <input type="text" name="telefono" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('oficiales.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded transition text-sm">Cancelar</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded shadow transition text-sm">Asignar Oficial</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>