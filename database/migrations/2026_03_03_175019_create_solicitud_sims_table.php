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
        Schema::create('solicitud_sims', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->foreignId('producto_id');
            $table->integer('cantidad'); // <--- Verifica que esta línea exista
            $table->foreignId('user_id');
            $table->string('estado')->default('pendiente');
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_sims');
    }
};
