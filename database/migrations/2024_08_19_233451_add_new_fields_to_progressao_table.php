<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToProgressaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progressao', function (Blueprint $table) {
            $table->string('nome_direcao')->nullable();
            $table->boolean('licence_maternidade')->default(0);
            $table->date('data_inicial_licenca')->nullable();
            $table->date('data_final_licenca')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('progressao', function (Blueprint $table) {
            $table->dropColumn('nome_direcao');
            $table->dropColumn('licence_maternidade');
            $table->dropColumn('data_inicial_licenca');
            $table->dropColumn('data_final_licenca');
        });
    }
}