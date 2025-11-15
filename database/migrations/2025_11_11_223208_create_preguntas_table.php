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
        // crea la tabla de preguntas
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consulta_id')
                  ->constrained('consultas')
                  ->onDelete('cascade');

            $table->text('texto');
            $table->string('tipo', 20)->default('opcion_unica');
            $table->integer('orden')->default(0);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
