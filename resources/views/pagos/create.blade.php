<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow px-6 py-4">
                <h1 class="text-2xl font-bold text-blue-900">📝 RECEPCIÓN DE PAGO / AMORTIZACIÓN</h1>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <div class="max-w-2xl bg-white rounded-lg shadow p-6">
                    <form action="{{ route('pagos.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Seleccionar Crédito Activo *</label>
                            <select name="credito_id" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Selecciona la cuenta del cliente --</option>
                                @foreach($creditos as $credito)
                                    <option value="{{ $credito->id }}">
                                        Cuenta #{{ $credito->id }} - {{ $credito->cliente->nombre }} {{ $credito->cliente->apellido }} ({{ $credito->automovil->marca }} {{ $credito->automovil->modelo }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Cantidad a Abonar ($) *</label>
                                <input type="number" step="0.01" name="monto" required placeholder="0.00" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha de Operación *</label>
                                <input type="date" name="fecha_pago" required value="{{ date('Y-m-d') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Método de Pago *</label>
                            <select name="metodo_pago" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Efectivo">💵 Efectivo / Ventanilla</option>
                                <option value="Transferencia">🏦 Transferencia SPEI</option>
                                <option value="Tarjeta de Crédito/Débito">💳 Tarjeta Bancaria</option>
                                <option value="Cheque">✍️ Cheque Certificado</option>
                            </select>
                        </div>

                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('pagos.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded transition text-sm">Cancelar</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded shadow transition text-sm">Aplicar Pago</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>