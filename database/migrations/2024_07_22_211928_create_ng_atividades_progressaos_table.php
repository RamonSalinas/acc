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
        Schema::create('ng_atividades_progressao', function (Blueprint $table) {
            $table->id();
            $table->string('nome_da_atividade');
            $table->unsignedBigInteger('ad_grupo_progressao_id');
            $table->float('referencia', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ng_atividades_progressao');

    }
};
