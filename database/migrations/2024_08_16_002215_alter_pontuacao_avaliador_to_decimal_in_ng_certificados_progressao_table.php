<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPontuacaoAvaliadorToDecimalInNgCertificadosProgressaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ng_certificados_progressao', function (Blueprint $table) {
            $table->decimal('pontuacao_avaliador', 8, 2)->change();
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
            $table->integer('pontuacao_avaliador')->change();
        });
    }
}