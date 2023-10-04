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
        Schema::create('relacion_alumno_materia_profesor', function (Blueprint $table) {
            $table->id('ID_Relacion');
            $table->unsignedBigInteger('ID_Alumno');
            $table->unsignedBigInteger('ID_Materia');
            $table->unsignedBigInteger('ID_Profesor');
            $table->timestamps();

            $table->foreign('ID_Alumno')->references('id')->on('alumnos');
            $table->foreign('ID_Profesor')->references('id')->on('profesores');
            $table->foreign('ID_Materia')->references('id')->on('materias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relacion_alumno_materia_profesor');
    }
};
