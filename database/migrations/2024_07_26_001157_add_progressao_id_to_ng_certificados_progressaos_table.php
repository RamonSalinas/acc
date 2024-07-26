<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ng_certificados_progressao', function (Blueprint $table) {
            $table->unsignedBigInteger('progressao_id')->nullable();
    
            $table->foreign('progressao_id')->references('id')->on('progressao')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('ng_certificados_progressao', function (Blueprint $table) {
            $table->dropForeign(['progressao_id']);
            $table->dropColumn('progressao_id');
        });
    }
};