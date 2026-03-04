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
        Schema::create('despacho_sims', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->foreignId('solicitud_sim_id')->nullable()->constrained('solicitud_sims')->nullOnDelete();
            $table->string('estado')->default('completado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('despacho_sims');
    }
};
