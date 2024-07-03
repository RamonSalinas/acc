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
                ['descricao' => 'Disciplina cursada com aprovação e não contabilizada para a integralização da carga horária do curso, realizada na UFOB ou em curso de graduação, autorizado pelo MEC, de outra instituição de educação superior;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Curso de natureza acadêmica, técnico-científica, socioambiental, artístico-cultural e de educação profissional presencial;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Curso de natureza acadêmica, técnico-científica, socioambiental, artístico-cultural e de educação profissional online síncrono;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'Curso de natureza acadêmica, técnico-científica, socioambiental, artístico-cultural e de educação profissional a distância;', 'valor_unitario' => 45.00, 'percentual_maximo' => 14.00],
                ['descricao' => 'Monitoria em disciplina que compõe o Projeto Pedagógico de Curso na graduação da UFOB;', 'valor_unitario' => 25.00, 'percentual_maximo' => 8.00],
                ['descricao' => 'Tutoria em projetos educacionais e de educação profissional;', 'valor_unitario' => 35.00, 'percentual_maximo' => 11.00],
                ['descricao' => 'Premiação de trabalho acadêmico de ensino;', 'valor_unitario' => 60.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'Mobilidade/intercâmbio acadêmico;', 'valor_unitario' => 70.00, 'percentual_maximo' => 25.00],
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
                ['descricao' => 'Participação em Projeto de Iniciação Científica, Projeto de Iniciação de Desenvolvimento Tecnológico e de Inovação e demais projetos de pesquisa devidamente registrados na UFOB ou em outras instituições de educação superior e centros de pesquisa;', 'valor_unitario' => 55.00, 'percentual_maximo' => 17.00],
                ['descricao' => 'Publicação de resumo simples ou expandido em anais de eventos técnico-científicos locais, regionais, nacionais ou internacionais;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'Publicação de artigo em periódico científico nacional ou internacional;', 'valor_unitario' => 70.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'Publicação de matéria em jornal e/ou revista;', 'valor_unitario' => 35.00, 'percentual_maximo' => 11.00],
                ['descricao' => 'Organização e publicação de livro;', 'valor_unitario' => 100.00, 'percentual_maximo' => 30.00],
                ['descricao' => 'Publicação de capítulo de livro;', 'valor_unitario' => 45.00, 'percentual_maximo' => 13.00],
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
                ['descricao' => 'Participação em grupo de extensão;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Outras atividades relativas ao grupo que o curso julgar importante e que não constam descritas nos itens anteriores.', 'valor_unitario' => 35.00, 'percentual_maximo' => 11.00],
            ],
            '4' => [
                ['descricao' => 'Representação (titular ou suplente) em órgão colegiado da UFOB;', 'valor_unitario' => 25.00, 'percentual_maximo' => 8.00],
                ['descricao' => 'Representação (titular ou suplente) no Diretório Central dos Estudantes, em Diretório Acadêmico, Centro Acadêmico, Atléticas e outros órgãos de representação estudantil institucionalmente constituídos;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Participação em comissão permanente instituída por órgão colegiado e setores diretivos da UFOB;', 'valor_unitario' => 25.00, 'percentual_maximo' => 8.00],
                ['descricao' => 'Participação em comissão instituída por órgão colegiado e setores diretivos da UFOB;', 'valor_unitario' => 20.00, 'percentual_maximo' => 7.00],
                ['descricao' => 'Participação em comissões de elaboração de políticas institucionais instituídas por órgão colegiado superior ou setores diretivos da UFOB;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Representação estudantil (titular ou suplente) em entidades civis, constituídas formalmente;', 'valor_unitario' => 20.00, 'percentual_maximo' => 6.00],
                ['descricao' => 'Outras atividades relativas ao grupo que o curso julgar importante e que não constam descritas nos itens anteriores.', 'valor_unitario' => 25.00, 'percentual_maximo' => 8.00],
            ],
            '5' => [
                ['descricao' => 'Participação em atividade de iniciação ao trabalho técnico-profissional;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'Realização de estágio não obrigatório;', 'valor_unitario' => 45.00, 'percentual_maximo' => 14.00],
                ['descricao' => 'Participação como integrante de empresa júnior;', 'valor_unitario' => 35.00, 'percentual_maximo' => 11.00],
                ['descricao' => 'Outras atividades relativas ao grupo que o curso julgar importante e que não constam descritas nos itens anteriores.', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
            ],
            '6' => [
                ['descricao' => 'Participação em programas de iniciação à docência;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Participação em programas de iniciação à residência pedagógica;', 'valor_unitario' => 55.00, 'percentual_maximo' => 17.00],
                ['descricao' => 'Participação em programas de educação tutorial ou de educação pelo trabalho;', 'valor_unitario' => 45.00, 'percentual_maximo' => 14.00],
                ['descricao' => 'Participação em ligas acadêmicas;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Outras atividades relativas ao grupo que o curso julgar importante e que não constam descritas nos itens anteriores.', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
            ],
            '7' => [
                ['descricao' => 'Participação em eventos esportivos na condição de estudante atleta;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Participação em atividades artísticas e culturais;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Apresentação de trabalhos artísticos e culturais;', 'valor_unitario' => 35.00, 'percentual_maximo' => 11.00],
                ['descricao' => 'Organização de atividades esportivas, artísticas e culturais;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'Monitoria em projeto socioambiental ou artístico-cultural;', 'valor_unitario' => 25.00, 'percentual_maximo' => 8.00],
                ['descricao' => 'Premiação em trabalhos artísticos e culturais;', 'valor_unitario' => 45.00, 'percentual_maximo' => 14.00],
                ['descricao' => 'Elaboração de produtos artísticos e culturais;', 'valor_unitario' => 35.00, 'percentual_maximo' => 11.00],
                ['descricao' => 'Publicação de resumo simples ou expandido em anais de eventos técnico-científicos locais, regionais, nacionais ou internacionais, que abordam temas das atividades esportivas ou recreativas;', 'valor_unitario' => 30.00, 'percentual_maximo' => 9.00],
                ['descricao' => 'Publicação de artigo em periódico científico nacional ou internacional, que aborda atividades esportivas ou recreativas;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'Apresentação de trabalho esportivo (oral e/ou pôster) em evento;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Premiação por trabalho científico na área esportiva;', 'valor_unitario' => 55.00, 'percentual_maximo' => 16.00],
                ['descricao' => 'Participação e/ou organização de atividades recreativas;', 'valor_unitario' => 30.00, 'percentual_maximo' => 9.00],
                ['descricao' => 'Atividades de atenção aos grupos vulneráveis e outras ações de caráter inclusivo, reparatório e de reconhecimento, humanitário, identitário e social;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'Participação, como integrante, em campanhas nas áreas de ações afirmativas e assuntos estudantis, organizadas por órgãos públicos;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Participação em grupos de acolhimento das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 25.00, 'percentual_maximo' => 8.00],
                ['descricao' => 'Participação em coletivos estudantis;', 'valor_unitario' => 20.00, 'percentual_maximo' => 7.00],
                ['descricao' => 'Monitoria em programas ou projetos de ações afirmativas e assuntos estudantis;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'Organização ou participação em eventos ou atividades voltados à qualidade de vida, atenção à saúde e lazer;', 'valor_unitario' => 35.00, 'percentual_maximo' => 11.00],
                ['descricao' => 'Organização ou participação de ações de solidariedade, acessibilidade e inclusão, autocuidado e cuidado com outrem, conscientização de bons hábitos, convivência universitária, respeito à diversidade, temas transversais, práticas educativas e sociais;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'Elaboração de produtos voltados para as ações afirmativas e assuntos estudantis;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Publicação de resumo simples ou expandido em anais de eventos técnico-científicos locais, regionais, nacionais ou internacionais, que abordam temas das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 45.00, 'percentual_maximo' => 14.00],
                ['descricao' => 'Publicação de artigo em periódico científico nacional ou internacional, que aborda temas das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Organização e publicação de livro ou capítulo de livro na área das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 55.00, 'percentual_maximo' => 17.00],
                ['descricao' => 'Publicação de capítulo de livro na área das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'Apresentação de trabalho com tema em ações afirmativas e assuntos estudantis (oral e/ou pôster) em evento;', 'valor_unitario' => 60.00, 'percentual_maximo' => 18.00],
                ['descricao' => 'Premiação por trabalho científico na área das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 65.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'Participação em programas e comitês de apoio ao corpo discente;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'Outras atividades relativas ao grupo que o curso julgar importante e que não constam descritas nos itens anteriores.', 'valor_unitario' => 35.00, 'percentual_maximo' => 11.00],
            ],
        ];

        foreach ($gruposAtividades as $grupoId => $atividades) {
            foreach ($atividades as $atividade) {
                DB::table('atividades')->insert([
                    'grupo_id' => $grupoId,
                    'descricao' => $atividade['descricao'],
                    'valor_unitario' => $atividade['valor_unitario'],
                    'percentual_maximo' => $atividade['percentual_maximo'],
                ]);
            }
        }
    }
}
