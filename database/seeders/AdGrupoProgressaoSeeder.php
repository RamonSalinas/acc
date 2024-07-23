<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdGrupoProgressaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('ad_grupo_progressao')->insert([
            ['id' => 1, 'nome_grupo_progressao' => 'I - atividades de ensino na educação superior na UFOB ou em outras IES públicas, neste caso, aprovada pelo Consuni ou por instância competente com delegação e sem percepção de remuneração adicional:', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'nome_grupo_progressao' => 'II - desempenho didático:', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'nome_grupo_progressao' => 'III – orientação de estudantes na UFOB ou, no caso de orientação em outras IES públicas, aprovada pelo Consuni ou por instância competente com delegação:', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'nome_grupo_progressao' => 'IV - participação em bancas examinadoras:', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'nome_grupo_progressao' => 'V - cursos ou estágios de aperfeiçoamento, especialização e atualização, bem como obtenção de créditos e títulos de pós-graduação stricto sensu, exceto quando contabilizados para fins de promoção acelerada:', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'nome_grupo_progressao' => 'VI - produção científica, de inovação, técnica ou artística, relacionada à atividade desenvolvida na área de atuação do docente:', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'nome_grupo_progressao' => 'VII - atividade de extensão à comunidade, de cursos e de serviços:', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'nome_grupo_progressao' => 'VIII – atividade de pesquisa, relacionada a projetos de pesquisa, criação e inovação: ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'nome_grupo_progressao' => 'IX – Exercício de funções de direção, vice-direção, coordenação, vice-coordenação, assessoramento e chefia:', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'nome_grupo_progressao' => 'X - Representação, exceto se contemplado no item anterior, sendo que, no caso de membro suplente, considerar um quarto da pontuação:', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
