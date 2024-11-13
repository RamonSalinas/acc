<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPpcToAdCursosTable extends Migration
{
    public function up()
    {
        Schema::table('ad_cursos', function (Blueprint $table) {
            $table->string('ppc')->nullable(); // novo campo
        });
    }

    public function down()
    {
        Schema::table('ad_cursos', function (Blueprint $table) {
            $table->dropColumn('ppc');
        });
    }
}
