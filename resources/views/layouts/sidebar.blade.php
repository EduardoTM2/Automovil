<div class="w-64 bg-slate-900 text-white flex flex-col justify-between min-h-screen shadow-xl z-50">
    <div>
        <div class="p-5 text-center font-bold text-lg border-b border-slate-800 tracking-wider text-blue-400">
            🚗 SISTEMA COMPRA
        </div>
        
        <nav class="mt-5 px-2 space-y-1">
            <a href="/dashboard" class="flex items-center px-4 py-3 text-sm font-medium rounded-md text-gray-300 hover:bg-slate-800 hover:text-white transition">
                📊 INICIO
            </a>
            <a href="{{ route('clientes.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ Request::routeIs('clientes.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">
                👥 CLIENTES
            </a>
            <a href="{{ route('automoviles.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ Request::routeIs('automoviles.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">
                🚘 AUTOMÓVILES
            </a>
            <a href="{{ route('creditos.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ Request::routeIs('creditos.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">
                💳 CRÉDITOS
            </a>
            <a href="{{ route('pagos.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ Request::routeIs('pagos.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">
                💰 PAGOS
            </a>
            <a href="{{ route('facturas.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ Request::routeIs('facturas.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">
                📄 FACTURAS
            </a>
            <a href="{{ route('asesores.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ Request::routeIs('asesores.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">
                👥 ASESORES VENTA
            </a>
            <a href="{{ route('oficiales.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ Request::routeIs('oficiales.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-slate-800' }}">
                🪪 OFICIALES CRÉDITO
            </a>
        </nav>
    </div>

    <div class="p-4 border-t border-slate-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white text-sm py-2 px-4 rounded-md transition font-semibold">
                🚪 CERRAR SESIÓN
            </button>
        </form>
    </div>
</div>