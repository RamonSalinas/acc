<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddObservacaoToNgCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ng_certificados', function (Blueprint $table) {
            $table->text('observacao')->nullable()->after('arquivo'); // Adiciona o campo observacao após o campo arquivo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ng_certificados', function (Blueprint $table) {
            $table->dropColumn('observacao'); // Remove o campo observacao
        });
    }
}
