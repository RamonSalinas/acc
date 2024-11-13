<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ad_grupo')->insert([
            ['nome_grupo' => 'Atividades de Ensino'],
            ['nome_grupo' => 'Atividades de Pesquisa, Desenvolvimento e Inovação'],
            ['nome_grupo' => 'Atividades de Extensão'],
            ['nome_grupo' => 'Atividades de Representação Estudantil'],
            ['nome_grupo' => 'Atividades de Iniciação ao Trabalho'],
            ['nome_grupo' => 'Participação em programas, projetos ou atividades que integrem ensino, pesquisa e extensão'],
            ['nome_grupo' => 'Atividades esportiva, artísticas e culturais, e ações de solidariedade desenvolvidas no âmbito da UFOB'],
            ['nome_grupo' => 'EXTENSÃO'],
        ]);
    }
}
