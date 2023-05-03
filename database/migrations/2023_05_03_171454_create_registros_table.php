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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->float('ingresos_netos');
            $table->float('cantidad_solicitada');
            $table->dateTime('fecha_registro')->default(DB::raw('NOW()'));
            $table->integer('franja_comunicacion');
        });

        Schema::table('registros', function (Blueprint $table) {
            $table->unsignedBigInteger('experto_id')->nullable();
            $table->foreign('experto_id')->references('id')->on('expertos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registros');
    }
};
