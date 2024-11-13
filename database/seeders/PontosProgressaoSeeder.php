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
            ['promocao' => 'I', 'classe' => 'A', 'nivel' => '2', 'pontos' => 45],
            ['promocao' => 'II', 'classe' => 'B', 'nivel' => '1', 'pontos' => 45],
            ['promocao' => 'III', 'classe' => 'B', 'nivel' => '2', 'pontos' => 45],
            ['promocao' => 'IV', 'classe' => 'C', 'nivel' => '1', 'pontos' => 50],
            ['promocao' => 'V', 'classe' => 'C', 'nivel' => '2', 'pontos' => 50],
            ['promocao' => 'VI', 'classe' => 'C', 'nivel' => '3', 'pontos' => 60],
            ['promocao' => 'VII', 'classe' => 'C', 'nivel' => '4', 'pontos' => 60],
            ['promocao' => 'VIII', 'classe' => 'D', 'nivel' => '1', 'pontos' => 70],
            ['promocao' => 'IX', 'classe' => 'D', 'nivel' => '2', 'pontos' => 70],
            ['promocao' => 'X', 'classe' => 'D', 'nivel' => '3', 'pontos' => 80],
            ['promocao' => 'XI', 'classe' => 'D', 'nivel' => '3', 'pontos' => 80],
            ['promocao' => 'XII', 'classe' => 'E', 'nivel' => '1', 'pontos' => 100],
        ];

        DB::table('pontos_progressao')->insert($dados);
    }
}