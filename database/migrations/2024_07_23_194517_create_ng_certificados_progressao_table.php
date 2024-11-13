<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNgCertificadosProgressaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ng_certificados_progressao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ad_grupo_progressao_id');
            $table->unsignedBigInteger('ng_atividades_progressao_id');
            $table->string('referencia');
            $table->integer('quantidade');
            $table->decimal('pontuacao', 8, 2);
            $table->string('arquivo_progressao')->nullable();
            $table->date('data_inicial');
            $table->date('data_final');
            $table->text('observacao')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('id_usuario');
            $table->timestamps();

            $table->foreign('ad_grupo_progressao_id')->references('id')->on('ad_grupo_progressao')->onDelete('cascade');
            $table->foreign('ng_atividades_progressao_id')->references('id')->on('ng_atividades_progressao')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ng_certificados_progressao');
    }
}