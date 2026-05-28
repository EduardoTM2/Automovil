<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow px-6 py-4">
                <h1 class="text-2xl font-bold text-blue-900">📝 APERTURA DE CRÉDITO AUTOMOTRIZ</h1>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <div class="max-w-2xl bg-white rounded-lg shadow p-6">
                    <form action="{{ route('creditos.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Seleccionar Cliente *</label>
                            <select name="cliente_id" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Elige un comprador --</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }} ({{ $cliente->correo }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Seleccionar Vehículo *</label>
                            <select name="automovil_id" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Selecciona la unidad --</option>
                                @foreach($automoviles as $auto)
                                    <option value="{{ $auto->id }}">🚗 {{ $auto->marca }} {{ $auto->modelo }} ({{ $auto->anio }}) - ${{ number_format($auto->precio, 2) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Monto a Financiar ($) *</label>
                                <input type="number" step="0.01" name="monto_financiado" required placeholder="0.00" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Plazo de Amortización *</label>
                                {{-- Corregido: eliminado nombre duplicado --}}
                                <select name="plazo_meses" id="plazo_meses" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="12">12 Meses</option>
                                    <option value="24">24 Meses</option>
                                    <option value="36">36 Meses</option>
                                    <option value="48">48 Meses</option>
                                    <option value="60">60 Meses</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Dictamen Inicial *</label>
                            <select name="estado" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Pendiente">⏳ En Análisis (Pendiente)</option>
                                <option value="Aprobado">✅ Aprobado para Firma</option>
                                <option value="Rechazado">❌ Rechazado por Riesgo</option>
                            </select>
                        </div>

                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('creditos.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded transition text-sm">Cancelar</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded shadow transition text-sm">Otorgar Crédito</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>