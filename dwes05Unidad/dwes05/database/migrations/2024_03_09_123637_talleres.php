<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('talleres', function (Blueprint $table) {
            $table->id(); //Necesario para el ORM Eloquent
            /*Ubicación del taller (relación 1-N, dado que en una ubicación puede haber múltiples talleres)*/
            $table->unsignedBigInteger('ubicacion_id');
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones')->onDelete('cascade');
            $table->timestamps(); //Necesario para el ORM Eloquent

            $table->string('nombre', 50);
            $table->text('descripcion');
            $table->enum('dia_semana', ['L', 'M', 'X', 'J', 'V', 'S', 'D']);
            $table->time('hora_inicio', $precision = 0);
            $table->time('hora_fin', $precision = 0);
            $table->unsignedTinyInteger('cupo_maximo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talleres');
    }
};
