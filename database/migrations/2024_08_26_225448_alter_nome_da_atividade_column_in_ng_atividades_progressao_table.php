<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNomeDaAtividadeColumnInNgAtividadesProgressaoTable extends Migration
{
    public function up()
    {
        Schema::table('ng_atividades_progressao', function (Blueprint $table) {
            $table->string('nome_da_atividade', 500)->change(); // Aumente o tamanho conforme necessário
        });
    }

    public function down()
    {
        Schema::table('ng_atividades_progressao', function (Blueprint $table) {
            $table->string('nome_da_atividade', 255)->change(); // Revertendo para o tamanho original
        });
    }
}