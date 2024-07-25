<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProfessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professors', function (Blueprint $table) {
            // Adicionar novas colunas
            $table->string('siape')->nullable();
            $table->string('lotacao')->nullable();
            $table->date('admissao')->nullable();
            $table->string('classe')->nullable();
            $table->string('regime')->nullable();
            $table->string('nivel')->nullable();
            $table->date('data_ultima_progressao')->nullable();
            $table->date('intersticio_data_inicial')->nullable();
            $table->date('intersticio_data_final')->nullable();
        });

        // Renomear a coluna 'nome' para 'user_id'
        Schema::table('professors', function (Blueprint $table) {
            $table->renameColumn('nome', 'user_id');
        });

        // Alterar a coluna 'user_id' para não permitir valores nulos e adicionar a chave estrangeira
        Schema::table('professors', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professors', function (Blueprint $table) {
            // Reverter as mudanças
            $table->dropForeign(['user_id']);
            $table->renameColumn('user_id', 'nome');

            // Remover as novas colunas
            $table->dropColumn([
                'siape', 'lotacao', 'admissao', 'classe', 'regime', 'nivel',
                'data_ultima_progressao', 'intersticio_data_inicial', 'intersticio_data_final'
            ]);
        });
    }
}