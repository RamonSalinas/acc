<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPortariaFieldsToProgressaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progressao', function (Blueprint $table) {
            $table->string('num_portaria')->nullable()->after('data_final_licenca');
            $table->date('data_portaria')->nullable()->after('num_portaria');
            $table->string('arquivo_portaria')->nullable()->after('data_portaria');
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
            $table->dropColumn('num_portaria');
            $table->dropColumn('data_portaria');
            $table->dropColumn('arquivo_portaria');
        });
    }
}