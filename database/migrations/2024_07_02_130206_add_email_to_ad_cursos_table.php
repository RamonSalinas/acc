<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToAdCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_cursos', function (Blueprint $table) {
            $table->string('email')->after('ppc'); // Adicione a coluna email
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_cursos', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
}
