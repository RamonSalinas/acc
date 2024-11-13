<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ng_certificados', function (Blueprint $table) {
            $table->id();
            $table->string('nome_certificado');
            $table->integer('carga_horaria');
            $table->string('descricao');
            $table->string('local');
            $table->date('data_inicio');
            $table->date('data_final');
            $table->foreignId('id_tipo_atividade')->constrained('ng_atividades');
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->decimal('horas_ACC', 8, 2); // Alterado de integer para decimal
            $table->enum('type', ['pendente', 'aprovada', 'rejeitada'])->default('pendente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ng_certificados');
    }
};
