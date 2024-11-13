<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdCursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ad_cursos')->insert([
            [
                'nome_curso' => 'Bacharelado Interdisciplinar em Ciência e Tecnologia',
                'carga_horaria_curso' => 2552,
                'carga_horaria_ACC' => 60,
                'carga_horaria_Extensao' => 252,
                'created_at' => Carbon::parse('2024-05-25 15:29:07'),
                'updated_at' => Carbon::parse('2024-07-02 16:09:46'),
                'ppc' => '2023.1',
                'email' => 'cobict@ufob.edu.br',
            ],
            [
                'nome_curso' => 'Bacharelado Interdisciplinar em Ciência e Tecnologia',
                'carga_horaria_curso' => 2400,
                'carga_horaria_ACC' => 200,
                'carga_horaria_Extensao' => 0,
                'created_at' => Carbon::parse('2024-05-31 16:45:50'),
                'updated_at' => Carbon::parse('2024-07-02 16:10:00'),
                'ppc' => '2016.1',
                'email' => 'cobict@ufob.edu.br',
            ],
            [
                'nome_curso' => 'Engenharia Civil',
                'carga_horaria_curso' => 3960,
                'carga_horaria_ACC' => 50,
                'carga_horaria_Extensao' => 396,
                'created_at' => Carbon::parse('2024-06-08 23:10:33'),
                'updated_at' => Carbon::parse('2024-07-02 16:13:42'),
                'ppc' => '2023.1',
                'email' => 'ccet@ufob.edu.br',
            ],
            [
                'nome_curso' => 'Bacharelado em Matemática',
                'carga_horaria_curso' => 2408,
                'carga_horaria_ACC' => 133,
                'carga_horaria_Extensao' => 322,
                'created_at' => Carbon::parse('2024-06-16 17:15:59'),
                'updated_at' => Carbon::parse('2024-07-02 16:11:33'),
                'ppc' => '2023.1',
                'email' => 'ccet@ufob.edu.br',
            ],
            [
                'nome_curso' => 'Engenharia Civil',
                'carga_horaria_curso' => 3960,
                'carga_horaria_ACC' => 168,
                'carga_horaria_Extensao' => 0,
                'created_at' => Carbon::parse('2024-06-27 21:13:09'),
                'updated_at' => Carbon::parse('2024-07-02 16:13:51'),
                'ppc' => '2016.1',
                'email' => 'ccet@ufob.edu.br',
            ],
            [
                'nome_curso' => 'Bacharelado em Matemática',
                'carga_horaria_curso' => 2408,
                'carga_horaria_ACC' => 133,
                'carga_horaria_Extensao' => 0,
                'created_at' => Carbon::parse('2024-07-02 15:55:13'),
                'updated_at' => Carbon::parse('2024-07-02 16:11:46'),
                'ppc' => '2016.1',
                'email' => 'ccet@ufob.edu.br',
            ],
        ]);
    }
}
