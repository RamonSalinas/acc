<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProgressaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progressao', function (Blueprint $table) {
            $table->string('classe')->nullable();
            $table->string('regime')->nullable();
            $table->string('nivel')->nullable();
            $table->date('data_ultima_progressao')->nullable();
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
            $table->dropColumn('classe');
            $table->dropColumn('regime');
            $table->dropColumn('nivel');
            $table->dropColumn('data_ultima_progressao');
        });
    }
}