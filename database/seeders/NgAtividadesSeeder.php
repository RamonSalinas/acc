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
                ['descricao' => 'a) disciplina cursada com aprovação e não contabilizada para a integralização da carga horária do curso, realizada na UFOB ou em curso de graduação, autorizado pelo MEC, de outra instituição de educação superior;', 'valor_unitario' => 1.00, 'percentual_maximo' => 50.00],
                ['descricao' => 'b) curso de natureza acadêmica, técnico-científica, socioambiental, artístico-cultural e de educação profissional presencial;', 'valor_unitario' => 1.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'c) curso de natureza acadêmica, técnico-científica, socioambiental, artístico-cultural e de educação profissional online síncrono;', 'valor_unitario' => 1.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'd) curso de natureza acadêmica, técnico-científica, socioambiental, artístico-cultural e de educação profissional a distância;', 'valor_unitario' => 1.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'e) monitoria em disciplina que compõe o Projeto Pedagógico de Curso na graduação da UFOB;', 'valor_unitario' => 0.125, 'percentual_maximo' => 60.00],
                ['descricao' => 'f) tutoria em projetos educacionais e de educação profissional;', 'valor_unitario' => 0.125, 'percentual_maximo' => 60.00],
                ['descricao' => 'g) premiação de trabalho acadêmico de ensino;', 'valor_unitario' => 10.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'h) mobilidade/intercâmbio acadêmico;', 'valor_unitario' => 0.333, 'percentual_maximo' => 60.00],
                ['descricao' => 'i) participação na Semana de Integração Universitária;', 'valor_unitario' => 0.50, 'percentual_maximo' => 10.00],
                ['descricao' => 'j) Participação em palestras durante Escola de Estudos Temáticos;', 'valor_unitario' => 15.00, 'percentual_maximo' => 4.00],
                ['descricao' => 'k) Participação em cursos durante Escola de Estudos Temáticos;', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'l) Participação como ouvinte em eventos técnicos ou científicos internacionais, nacionais, regionais ou locais, de natureza acadêmica;', 'valor_unitario' => 50.00, 'percentual_maximo' => 15.00],
                ['descricao' => 'm) Certificação em proficiência em língua estrangeira emitida por instituição de ensino superior no país ou no exterior ou por exames de proficiência como TOEFL, IELTS, Cambridge, DELF, DALF, que avaliam as quatro habilidades;', 'valor_unitario' => 55.00, 'percentual_maximo' => 16.00],
                ['descricao' => 'n) Participação em grupo de estudo;', 'valor_unitario' => 20.00, 'percentual_maximo' => 6.00],
                ['descricao' => 'o) Participação em visitas técnicas extracurriculares;', 'valor_unitario' => 25.00, 'percentual_maximo' => 7.00],
                ['descricao' => 'p) Elaboração e desenvolvimento de recurso didático: tutorial, roteiro, aplicativo, apostila, jogo didático, ou similar;', 'valor_unitario' => 40.00, 'percentual_maximo' => 12.00],
                ['descricao' => 'q) Outras atividades relativas ao grupo que o curso julgar importante e que não constam descritas nos itens anteriores.', 'valor_unitario' => 30.00, 'percentual_maximo' => 10.00],
            ],
  
            '2' => [
                ['descricao' => 'a) participação em Projeto de Iniciação Científica, Projeto de Iniciação de Desenvolvimento Tecnológico e de Inovação e demais projetos de pesquisa devidamente registrados na UFOB ou em outras instituições de educação superior e centros de pesquisa;', 'valor_unitario' => 5.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'b) publicação de resumo simples ou expandido em anais de eventos técnico-científicos locais, regionais, nacionais ou internacionais;', 'valor_unitario' => 5.00, 'percentual_maximo' => 40.00],
                ['descricao' => 'c) publicação de artigo em periódico científico nacional ou internacional;', 'valor_unitario' => 30.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'd) publicação de matéria em jornal e/ou revista;', 'valor_unitario' => 10.00, 'percentual_maximo' => 30.00],
                ['descricao' => 'e) organização e publicação de livro;', 'valor_unitario' => 30.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'f) publicação de capítulo de livro;', 'valor_unitario' => 20.00, 'percentual_maximo' => 50.00],
                ['descricao' => 'g) apresentação (oral e/ou pôster) de trabalho em evento técnico-científico local, regional;', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'h) apresentação (oral e/ou pôster) de trabalho em evento técnico-científico nacional e/ou', 'valor_unitario' => 10.00, 'percentual_maximo' => 30.00],
                ['descricao' => 'i) premiação de trabalho acadêmico de pesquisa;', 'valor_unitario' => 10.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'j) produção e desenvolvimento de produto, artefato tecnológico ou registro de propriedade intelectual;', 'valor_unitario' => 30.00, 'percentual_maximo' => 50.00],
                ['descricao' => 'k) participação em grupo de pesquisa certificado pela UFOB no Diretório de Grupos de Pesquisa do CNPq;', 'valor_unitario' => 0.50, 'percentual_maximo' => 20.00],
                ['descricao' => 'l) desenvolvimento de código-fonte registrado em plataforma especializada.', 'valor_unitario' => 10.00, 'percentual_maximo' => 30.00],
                ['descricao' => 'm) Outras atividades relativas ao grupo que o curso julgar importante e que não consta descrita nos itens anteriores.', 'valor_unitario' => 1.00, 'percentual_maximo' => 20.00],
            ],
            '3' => [
                ['descricao' => 'a) participação como membro de equipe executora 1 h para cada 2 h de em ações de extensão das modalidades programa, atividade projeto, curso, evento e prestação de serviço', 'valor_unitario' => 0.50, 'percentual_maximo' => 60.00],
                ['descricao' => 'b) Publicação de resumo simples ou expandido em anais de eventos técnico-científicos locais, 5 h por atividade regionais, nacionais ou internacionais, que abordam ações extensionistas;', 'valor_unitario' => 5.00, 'percentual_maximo' => 30.00],
                ['descricao' => 'c) Publicação de artigo em periódico científico nacional ou internacional, que abordam ações extensionistas', 'valor_unitario' => 20.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'd) apresentação de trabalho extensionista em evento;', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'e) premiação por trabalho extensionista;', 'valor_unitario' => 10.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'f) participação na elaboração de produtos extensionistas, exceto aqueles incluídos na alínea b;', 'valor_unitario' => 30.00, 'percentual_maximo' => 50.00],
                ['descricao' => 'g) participação em grupo de extensão.', 'valor_unitario' => 0.50, 'percentual_maximo' => 20.00],
                ['descricao' => 'h) Outras atividades relativas ao grupo que o curso 1h para cada 1h de julgar importante e que não consta descrita nos itens anteriores.', 'valor_unitario' => 1.00, 'percentual_maximo' => 20.00],
            ],
            '4' => [
                ['descricao' => 'a) representação (titular ou suplente) em órgão colegiado da UFOB', 'valor_unitario' => 5.00, 'percentual_maximo' => 40.00],
                ['descricao' => 'b) representação (titular ou suplente) no Diretório Central dos Estudantes, em Diretório Acadêmico, Centro Acadêmico, Atléticas e outros órgãos de representação estudantil institucionalmente constituídos;', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'c) participação em comissão permanente instituída por órgão colegiado e setores diretivos da UFOB;', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'd) participação em comissão instituída por órgão colegiado e setores diretivos da UFOB', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'e) participação em comissões de elaboração de políticas institucionais instituída por órgão colegiado superior ou setores diretivos da UFOB;', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'f) representação estudantil (titular ou suplente) em entidades civis, constituídas formalmente.', 'valor_unitario' => 5.00, 'percentual_maximo' => 30.00],
                ['descricao' => 'g) Outras atividades relativas ao grupo que o curso julgar importante e que não consta descrita nos itens anteriores.', 'valor_unitario' => 1.00, 'percentual_maximo' => 20.00],
            ],
                '5' => [
                ['descricao' => 'a participação em atividade de iniciação ao trabalho técnico-profissional;', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'b realização de estágio não obrigatório;', 'valor_unitario' => 10.00, 'percentual_maximo' => 30.00],
                ['descricao' => 'c participação como integrante de empresa júnior', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'd Outras atividades relativas ao grupo que o curso de julgar importante e que não consta descrita nos itens anteriores', 'valor_unitario' => 1.00, 'percentual_maximo' => 20.00],
            ],
            '6' => [
                ['descricao' => 'a) participação em programas de iniciação à docência;', 'valor_unitario' => 7.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'b) participação em programas de iniciação à residência pedagógica;', 'valor_unitario' => 7.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'c) participação em programas de educação tutorial ou de educação pelo trabalho;', 'valor_unitario' => 3.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'd) participação em ligas acadêmicas;', 'valor_unitario' => 1.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'e) Outras atividades relativas ao grupo que o curso julgar importante e que não consta descrita nos itens anteriores', 'valor_unitario' => 1.00, 'percentual_maximo' => 20.00],
            ],
            '7' => [
                ['descricao' => 'a) participação em eventos esportivos na condição de estudante atleta;', 'valor_unitario' => 0.20, 'percentual_maximo' => 20.00],
                ['descricao' => 'b) participação em atividades artísticas e culturais;', 'valor_unitario' => 1.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'c) apresentação de trabalhos artísticos e culturais;', 'valor_unitario' => 2.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'd) organização de atividades esportivas, artísticas e culturais;', 'valor_unitario' => 0.40, 'percentual_maximo' => 20.00],
                ['descricao' => 'e) monitoria em projeto socioambiental ou artístico-cultural;', 'valor_unitario' => 0.125, 'percentual_maximo' => 60.00],
                ['descricao' => 'f) premiação em trabalhos artísticos e culturais;', 'valor_unitario' => 10.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'g) elaboração de produtos artísticos e culturais;', 'valor_unitario' => 30.00, 'percentual_maximo' => 50.00],
                ['descricao' => 'h) publicação de resumo simples ou expandido em anais de eventos técnico-científicos locais, regionais, nacionais ou internacionais, que abordam temas das atividades esportivas ou recreativas;', 'valor_unitario' => 5.00, 'percentual_maximo' => 40.00],
                ['descricao' => 'i) publicação de artigo em periódico científico nacional ou internacional, que abordam atividades esportivas ou recreativas;', 'valor_unitario' => 30.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'j) apresentação de trabalho esportivo (oral e/ou por atividade pôster) em evento;', 'valor_unitario' => 2.00, 'percentual_maximo' => 10.00],
                ['descricao' => 'k) premiação por trabalho científico na área por atividade esportiva;', 'valor_unitario' => 10.00, 'percentual_maximo' => 40.00],
                ['descricao' => 'l) participação e /ou organização de atividades recreativas;', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'm) atividades de atenção aos grupos vulneráveis e outras ações de caráter inclusivo, reparatório e de reconhecimento, humanitário, identitário e social;', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'n) participação, como integrante, em campanhas nas áreas de atividades de ações afirmativas e assuntos estudantis, organizadas por órgãos públicos;', 'valor_unitario' => 5.00, 'percentual_maximo' => 40.00],
                ['descricao' => 'o) participação em grupos de acolhimento das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 5.00, 'percentual_maximo' => 40.00],
                ['descricao' => 'p) participação em coletivos estudantis;', 'valor_unitario' => 1.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'q) monitoria em programas ou projetos de ações afirmativas e assuntos estudantis;', 'valor_unitario' => 0.125, 'percentual_maximo' => 60.00],
                ['descricao' => 'r) organização ou participação em eventos ou atividades voltados à qualidade de vida, atenção à saúde e lazer;', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 's) organização ou participação de ações de solidariedade, acessibilidade e inclusão, autocuidado e cuidado com outrem, conscientização de bons hábitos, convivência universitária, respeito à diversidade, temas transversais, práticas educativas e sociais, e', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 't) elaboração de produtos voltados para as ações afirmativas e assuntos estudantis;', 'valor_unitario' => 30.00, 'percentual_maximo' => 50.00],
                ['descricao' => 'u) publicação de resumo simples ou expandido em anais de eventos técnico-científicos locais, regionais, nacionais ou internacionais, que abordam temas das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 5.00, 'percentual_maximo' => 30.00],
                ['descricao' => 'v) publicação de artigo em periódico científico nacional ou internacional, que abordam temas das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 30.00, 'percentual_maximo' => 60.00],
                ['descricao' => 'w) organização e publicação de livro ou capítulo de livro na área das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 30.00, 'percentual_maximo' => 50.00],
                ['descricao' => 'x) publicação de capítulo de livro na área das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 10.00, 'percentual_maximo' => 40.00],
                ['descricao' => 'y) apresentação de trabalho com tema em ações afirmativas e assuntos estudantis (oral e/ou pôster) em evento;', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'z) premiação por trabalho científico na área das ações afirmativas e assuntos estudantis;', 'valor_unitario' => 10.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'aa) participação e /ou organização de eventos das ações afirmativas e assuntos estudantis.', 'valor_unitario' => 5.00, 'percentual_maximo' => 20.00],
                ['descricao' => 'ab) Outras atividades relativas ao grupo que o curso julgar importante e que não consta descrita nos itens anteriores', 'valor_unitario' => 1.00, 'percentual_maximo' => 20.00],
            ],


        ];

        foreach ($gruposAtividades as $grupo => $atividades) {
            foreach ($atividades as $atividade) {
                DB::table('ng_atividades')->insert([
                    'grupo_atividades' => $grupo,
                    'nome_atividade' => $atividade['descricao'],
                    'valor_unitario' => $atividade['valor_unitario'],
                    'percentual_maximo' => $atividade['percentual_maximo'],
                ]);
            }
        }
    }
}
