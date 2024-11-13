<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNgAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ng_atividades', function (Blueprint $table) {
            // Adicionar coluna de relacionamento com a tabela ad_grupo
            $table->unsignedBigInteger('grupo_atividades_id')->nullable();

            // Adicionar a chave estrangeira
            $table->foreign('grupo_atividades_id')
                  ->references('id')
                  ->on('ad_grupo')
                  ->onDelete('set null');

            // Remover a antiga coluna se necessário
            // $table->dropColumn('grupo_atividades'); // descomente esta linha se deseja remover a coluna antiga
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ng_atividades', function (Blueprint $table) {
            // Remover a chave estrangeira e a coluna de relacionamento
            $table->dropForeign(['grupo_atividades_id']);
            $table->dropColumn('grupo_atividades_id');

            // Adicionar a coluna antiga de volta, se removida
            // $table->string('grupo_atividades'); // descomente esta linha se removeu a coluna antiga na migração up()
        });
    }
}
