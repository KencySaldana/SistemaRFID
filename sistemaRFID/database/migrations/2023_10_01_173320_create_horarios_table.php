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
            $table->id('ID_Horario');
            $table->timestamps();
            
            $table->string('dia');
            $table->time('hora_inicio');
            $table->time('hora_fin');


            $table->unsignedBigInteger('ID_Profesor');
            $table->unsignedBigInteger('ID_Materia');

            
            $table->foreign('ID_Profesor')->references('id')->on('profesores');
            $table->foreign('ID_Materia')->references('id')->on('materias');

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
