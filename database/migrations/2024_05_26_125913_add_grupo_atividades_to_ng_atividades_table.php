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
        Schema::table('ng_atividades', function (Blueprint $table) {
            $table->string('grupo_atividades')->nullable()->change(); // Tornar a coluna nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ng_atividades', function (Blueprint $table) {
            $table->string('grupo_atividades')->nullable(false)->change(); // Reverter para não-nullable se necessário
        });
    }
};
