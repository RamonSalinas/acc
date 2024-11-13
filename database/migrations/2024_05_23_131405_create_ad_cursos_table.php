<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ad_cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_curso');
            $table->integer('carga_horaria_curso');
            $table->integer('carga_horaria_ACC');
            $table->integer('carga_horaria_Extensao');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ad_cursos');
    }
};
