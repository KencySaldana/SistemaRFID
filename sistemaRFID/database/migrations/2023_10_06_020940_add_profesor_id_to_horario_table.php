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
        Schema::table('horarios', function (Blueprint $table) {
            // Otras columnas en la tabla profesor_horario
            $table->unsignedBigInteger('profesor_id'); // Esto debe coincidir con la columna en la tabla profesores
            $table->foreign('profesor_id')->references('id')->on('profesores')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('horarios', function (Blueprint $table) {
            //
            $table->dropColumn('profesor_id');
        });
    }
};
