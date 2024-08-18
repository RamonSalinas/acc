<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PontosProgressaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            ['promocao' => 'I', 'classe' => 'A', 'nivel' => 'II', 'pontos' => 45],
            ['promocao' => 'II', 'classe' => 'B', 'nivel' => 'I', 'pontos' => 45],
            ['promocao' => 'III', 'classe' => 'B', 'nivel' => 'II', 'pontos' => 45],
            ['promocao' => 'IV', 'classe' => 'C', 'nivel' => 'I', 'pontos' => 50],
            ['promocao' => 'V', 'classe' => 'C', 'nivel' => 'II', 'pontos' => 50],
            ['promocao' => 'VI', 'classe' => 'C', 'nivel' => 'III', 'pontos' => 60],
            ['promocao' => 'VII', 'classe' => 'C', 'nivel' => 'IV', 'pontos' => 60],
            ['promocao' => 'VIII', 'classe' => 'D', 'nivel' => 'I', 'pontos' => 70],
            ['promocao' => 'IX', 'classe' => 'D', 'nivel' => 'II', 'pontos' => 70],
            ['promocao' => 'X', 'classe' => 'D', 'nivel' => 'III', 'pontos' => 80],
            ['promocao' => 'XI', 'classe' => 'D', 'nivel' => 'IV', 'pontos' => 80],
            ['promocao' => 'XII', 'classe' => 'E', 'nivel' => 'I', 'pontos' => 100],
        ];

        DB::table('pontos_progressao')->insert($dados);
    }
}