<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Asesores de Ventas
        Schema::create('asesores_ventas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('telefono')->nullable();
            $table->string('correo')->unique();
            $table->timestamps();
        });

        // 2. Oficiales de Crédito
        Schema::create('oficiales_credito', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('departamento')->nullable();
            $table->string('telefono')->nullable();
            $table->timestamps();
        });

        // 3. Clientes
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->text('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->unique();
            $table->timestamps();
        });

        // 4. Automóviles
        Schema::create('automoviles', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('modelo');
            $table->integer('anio');
            $table->decimal('precio', 10, 2);
            $table->timestamps();
        });

        // 5. Créditos
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('automovil_id')->constrained('automoviles')->onDelete('cascade');
            
            // Campos ajustados a tu controlador
            $table->decimal('monto_financiado', 12, 2); 
            $table->integer('plazo_meses');
            $table->string('estado')->default('Pendiente');
            
            $table->timestamps();
        });

        // 6. Pagos
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('credito_id')->constrained('creditos')->onDelete('cascade');
            $table->date('fecha');
            $table->decimal('monto', 10, 2);
            $table->timestamps();
        });

        // 7. Facturas
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('automovil_id')->constrained('automoviles')->onDelete('cascade');
            $table->decimal('precio', 10, 2);
            $table->date('fecha');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas');
        Schema::dropIfExists('pagos');
        Schema::dropIfExists('creditos');
        Schema::dropIfExists('automoviles');
        Schema::dropIfExists('clientes');
        Schema::dropIfExists('oficiales_credito');
        Schema::dropIfExists('asesores_ventas');
    }
};