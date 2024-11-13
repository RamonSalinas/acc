<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGrupoAtividadesToNgCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ng_certificados', function (Blueprint $table) {
            $table->integer('grupo_atividades')->nullable();
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
            $table->dropColumn('grupo_atividades');
        });
    }
}
