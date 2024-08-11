<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToNgCertificadosProgressaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ng_certificados_progressao', function (Blueprint $table) {
            $table->integer('quantidade_avaliador')->default(0);
            $table->integer('pontuacao_avaliador')->default(0);
            $table->text('observacao_avaliador')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ng_certificados_progressao', function (Blueprint $table) {
            $table->dropColumn('quantidade_avaliador');
            $table->dropColumn('pontuacao_avaliador');
            $table->dropColumn('observacao_avaliador');
        });
    }
}