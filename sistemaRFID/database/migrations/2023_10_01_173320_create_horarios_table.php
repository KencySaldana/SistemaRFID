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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id('id_horario');
            $table->string('dia');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('id_materia');
            $table->string('id_profesor');

            // $table->unsignedBigInteger('ID_Profesor');
            // $table->unsignedBigInteger('ID_Materia');

            
            // $table->foreign('ID_Profesor')->references('id')->on('profesores');
            // $table->foreign('ID_Materia')->references('id')->on('materias');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
