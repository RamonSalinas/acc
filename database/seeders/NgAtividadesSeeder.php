<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NgAtividadesSeeder extends Seeder
{
    public function run()
    {
        $gruposAtividades = [
            '1' => [
                ['descricao' => 'Disciplina cursada com aprovação e não contabilizada para a integralização da carga horária do curso, realizada na UFOB ou em curso de graduação, autorizado pelo MEC, de outra instituição de educação superior;', 'valor_unitario' => 1.00, 'percentual_maximo' => 50.00],
                ['descricao' => 'Curso de natureza acadêmica, técnico-científica, socioambiental, artístico-cultural e de educação profissional presencial;', 'valor_unitario' => 1.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'Curso de natureza acadêmica, técnico-científica, socioambiental, artístico-cultural e de educação profissional online síncrono;', 'valor_unitario' => 1.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Curso de natureza acadêmica, técnico-científica, socioambiental, artístico-cultural e de educação profissional a distância;', 'valor_unitario' => 1.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Monitoria em disciplina que compõe o Projeto Pedagógico de Curso na graduação da UFOB;', 'valor_unitario' => 0.125, 'percentual_maximo' => 60.00],
                ['descricao' => 'Tutoria em projetos educacionais e de educação profissional;', 'valor_unitario' => 0.125, 'percentual_maximo' => 60.00],
                ['descricao' => 'Premiação de trabalho acadêmico de ensino;', 'valor_unitario' => 10.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'Mobilidade/intercâmbio acadêmico;', 'valor_unitario' => 0.333, 'percentual_maximo' => 60.00],
                ['descricao' => 'Participação na Semana de Integração Universitária;', 'valor_unitario' => 20.00, 'percentual_maximo' => 5.00],
                ['descricao' => 'Participação em palestras durante Escola de Estudos Temáticos;', 'valor_unitario' => 15.00, 'percentual_maximo' => 4.00],
                ['descricao' => 'Participação em cursos durante Escola de Estudos Temáticos;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Participação como ouvinte em eventos técnicos ou científicos internacionais, nacionais, regionais ou locais, de natureza acadêmica;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Certificação em proficiência em língua estrangeira emitida por instituição de ensino superior no país ou no exterior ou por exames de proficiência como TOEFL, IELTS, Cambridge, DELF, DALF, que avaliam as quatro habilidades;', 'valor_unitario' => 55.00, 'percentual_maximo' => 16.00],
                ['descricao' => 'Participação em grupo de estudo;', 'valor_unitario' => 20.00, 'percentual_maximo' => 6.00],
                ['descricao' => 'Participação em visitas técnicas extracurriculares;', 'valor_unitario' => 25.00, 'percentual_maximo' => 7.00],
                ['descricao' => 'Elaboração e desenvolvimento de recurso didático: tutorial, roteiro, aplicativo, apostila, jogo didático, ou similar;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'Outras atividades relativas ao grupo que o curso julgar importante e que não constam descritas nos itens anteriores.', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
            ],
            '2' => [
                ['descricao' => 'Participação em Projeto de Iniciação Científica, Projeto de Iniciação de Desenvolvimento Tecnológico e de Inovação e demais projetos de pesquisa devidamente registrados na UFOB ou em outras instituições de educação superior e centros de pesquisa;', 'valor_unitario' => 5.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'Publicação de resumo simples ou expandido em anais de eventos técnico-científicos locais, regionais, nacionais ou internacionais;', 'valor_unitario' => 5.00, 'percentual_maximo' => 40.00],
                ['descricao' => 'Publicação de artigo em periódico científico nacional ou internacional;', 'valor_unitario' => 30.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'Publicação de matéria em jornal e/ou revista;', 'valor_unitario' => 10.00, 'percentual_maximo' => 30.00],
                ['descricao' => 'Organização e publicação de livro;', 'valor_unitario' => 30.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'Publicação de capítulo de livro;', 'valor_unitario' => 20.00, 'percentual_maximo' => 50.00],
                ['descricao' => 'Apresentação (oral e/ou pôster) de trabalho em evento técnico-científico local ou regional;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Apresentação (oral e/ou pôster) de trabalho em evento técnico-científico nacional e/ou internacional;', 'valor_unitario' => 60.00, 'percentual_maximo' => 18.00],
                ['descricao' => 'Premiação de trabalho acadêmico de pesquisa;', 'valor_unitario' => 70.00, 'percentual_maximo' => 22.00],
                ['descricao' => 'Produção e desenvolvimento de produto, artefato tecnológico ou registro de propriedade intelectual;', 'valor_unitario' => 85.00, 'percentual_maximo' => 25.00],
                ['descricao' => 'Participação em grupo de pesquisa certificado pela UFOB no Diretório de Grupos de Pesquisa do CNPq;', 'valor_unitario' => 45.00, 'percentual_maximo' => 14.00],
                ['descricao' => 'Desenvolvimento de código-fonte registrado em plataforma especializada;', 'valor_unitario' => 50.00, 'percentual_maximo' => 16.00],
                ['descricao' => 'Outras atividades relativas ao grupo que o curso julgar importante e que não constam descritas nos itens anteriores.', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
            ],
            '3' => [
                ['descricao' => 'Participação como membro de equipe executora em ações de extensão das modalidades programa, atividade, projeto, curso, evento e prestação de serviço;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Publicação de resumo simples ou expandido em anais de eventos técnico-científicos locais, regionais, nacionais ou internacionais, que abordam ações extensionistas;', 'valor_unitario' => 35.00, 'percentual_maximo' => 11.00],
                ['descricao' => 'Publicação de artigo em periódico científico nacional ou internacional, que aborda ações extensionistas;', 'valor_unitario' => 45.00, 'percentual_maximo' => 14.00],
                ['descricao' => 'Apresentação de trabalho extensionista em evento;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Premiação por trabalho extensionista;', 'valor_unitario' => 60.00, 'percentual_maximo' => 18.00],
                ['descricao' => 'Participação na elaboração de produtos extensionistas, exceto aqueles incluídos na alínea b;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'Participação em grupo de trabalho extensionista registrado na UFOB;', 'valor_unitario' => 25.00, 'percentual_maximo' => 8.00],
                ['descricao' => 'Outras atividades relativas ao grupo que o curso julgar importante e que não constam descritas nos itens anteriores.', 'valor_unitario' => 35.00, 'percentual_maximo' => 10.00],
            ],
            '4' => [
                ['descricao' => 'Estágio não obrigatório em entidade ou empresa, com carga horária mínima de 40 horas, cujo supervisor seja um profissional da área de formação do estudante;', 'valor_unitario' => 25.00, 'percentual_maximo' => 8.00],
                ['descricao' => 'Estágio não obrigatório em entidade ou empresa, com carga horária mínima de 80 horas, cujo supervisor seja um profissional da área de formação do estudante;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Estágio não obrigatório em entidade ou empresa, com carga horária mínima de 160 horas, cujo supervisor seja um profissional da área de formação do estudante;', 'valor_unitario' => 75.00, 'percentual_maximo' => 22.00],
                ['descricao' => 'Estágio não obrigatório em entidade ou empresa, com carga horária mínima de 320 horas, cujo supervisor seja um profissional da área de formação do estudante;', 'valor_unitario' => 100.00, 'percentual_maximo' => 30.00],
                ['descricao' => 'Estágio não obrigatório em entidade ou empresa, com carga horária mínima de 480 horas, cujo supervisor seja um profissional da área de formação do estudante;', 'valor_unitario' => 150.00, 'percentual_maximo' => 40.00],
                ['descricao' => 'Elaboração de relatório técnico-científico referente a estágio não obrigatório em entidade ou empresa;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Outras atividades relativas ao grupo que o curso julgar importante e que não constam descritas nos itens anteriores.', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
            ],
        ];

        foreach ($gruposAtividades as $grupo => $atividades) {
            foreach ($atividades as $atividade) {
                DB::table('ng_atividades')->insert([
                    'grupo' => $grupo,
                    'descricao' => $atividade['descricao'],
                    'valor_unitario' => $atividade['valor_unitario'],
                    'percentual_maximo' => $atividade['percentual_maximo'],
                ]);
            }
        }
    }
}
