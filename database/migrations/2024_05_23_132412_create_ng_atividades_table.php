<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ng_atividades', function (Blueprint $table) {
            $table->id();
            $table->integer('grupo_atividades')->default(1); 
            $table->string('nome_atividade');
            $table->decimal('valor_unitario', 8, 3); // Alterado de integer para decimal
            $table->decimal('percentual_maximo', 8, 3); // Alterado de integer para decimal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ng_atividades');
    }
};
