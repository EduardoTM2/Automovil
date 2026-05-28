<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow px-6 py-4">
                <h1 class="text-2xl font-bold text-blue-900">
                    {{ isset($automovil) ? '✏️ MODIFICAR REGISTRO DE VEHÍCULO' : '📝 ALTA DE VEHÍCULO NUEVO / SEMINUEVO' }}
                </h1>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <div class="max-w-2xl bg-white rounded-lg shadow p-6">
                    <form action="{{ isset($automovil) ? route('automoviles.update', $automovil->id) : route('automoviles.store') }}" method="POST" class="space-y-4">
                        @csrf
                        @if(isset($automovil))
                            @method('PUT')
                        @endif
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Marca *</label>
                                <input type="text" name="marca" value="{{ $automovil->marca ?? '' }}" required placeholder="Ej: Nissan, Toyota" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Modelo *</label>
                                <input type="text" name="modelo" value="{{ $automovil->modelo ?? '' }}" required placeholder="Ej: Versa, Hilux" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Año Modelo *</label>
                                <input type="number" name="anio" value="{{ $automovil->anio ?? '' }}" required min="1900" max="{{ date('Y') + 1 }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Precio de Lista ($) *</label>
                                <input type="number" step="0.01" name="precio" value="{{ $automovil->precio ?? '' }}" required placeholder="0.00" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('automoviles.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded transition text-sm">Cancelar</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded shadow transition text-sm">
                                {{ isset($automovil) ? 'Actualizar Cambios' : 'Guardar Auto' }}
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>