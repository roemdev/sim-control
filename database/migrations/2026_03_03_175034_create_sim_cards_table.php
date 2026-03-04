<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sim_cards', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->unique();
            $table->string('numero_telefono')->unique();
            $table->foreignId('producto_id')->constrained('productos'); // De qué tipo es este SIM
            $table->string('estado')->default('disponible');

            // Relación con la solicitud (puede ser nula si está guardada en la gaveta)
            $table->foreignId('solicitud_sim_id')->nullable()->constrained('solicitud_sims')->nullOnDelete();
            $table->timestamp('fecha_asignacion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sim_cards');
    }
};
