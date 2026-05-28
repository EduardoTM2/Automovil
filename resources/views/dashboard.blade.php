<x-app-layout>
    <div class="flex h-screen bg-gray-100">
        {{-- Cargamos tu barra lateral original --}}
        @include('layouts.sidebar') 

        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Encabezado del sistema --}}
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-900">🚀 PANEL DE CONTROL PRINCIPAL</h1>
                <span class="text-sm font-semibold text-gray-600 bg-gray-200 px-3 py-1 rounded-full">
                    Bienvenido, {{ Auth::user()->name }} 👋
                </span>
            </header>

            {{-- Contenido principal --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                <div class="bg-white rounded-lg shadow p-6 max-w-4xl">
                    <h2 class="text-xl font-bold text-gray-800 mb-2">¡Inicio de sesión exitoso!</h2>
                    <p class="text-gray-600 mb-6">Has accedido correctamente al sistema de Crédito y Compra de Automóviles. Utiliza la barra lateral para gestionar los diferentes módulos disponibles.</p>
                    
                    {{-- Tarjetas de acceso rápido para la entrega --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition shadow-sm bg-slate-50">
                            <h3 class="font-bold text-blue-900 text-lg mb-1">👥 Módulo Clientes</h3>
                            <p class="text-xs text-gray-500 mb-3">Altas, bajas, cambios y catálogo de clientes registrados.</p>
                            <a href="{{ route('clientes.index') }}" class="text-sm text-blue-600 font-semibold hover:underline">Ir a Clientes →</a>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 transition shadow-sm bg-slate-50">
                            <h3 class="font-bold text-blue-900 text-lg mb-1">🚘 Inventario de Autos</h3>
                            <p class="text-xs text-gray-500 mb-3">Control de stock de unidades nuevas y seminuevas.</p>
                            <a href="{{ route('automoviles.index') }}" class="text-sm text-blue-600 font-semibold hover:underline">Ir al Inventario →</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-app-layout>