<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressaoTable extends Migration
{
    public function up()
    {
        Schema::create('progressao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professor_id')->constrained('professors');
            $table->string('nome_progressao');
            $table->date('intersticio_data_inicial');
            $table->date('intersticio_data_final');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('progressao');
    }
}
