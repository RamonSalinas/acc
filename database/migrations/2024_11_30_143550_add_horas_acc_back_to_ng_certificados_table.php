<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHorasAccBackToNgCertificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ng_certificados', function (Blueprint $table) {
            $table->integer('horas_ACC_Back')->nullable()->after('horas_ACC');
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
            $table->dropColumn('horas_ACC_Back');
        });
    }
}