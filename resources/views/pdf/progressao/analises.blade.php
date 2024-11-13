<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .centralizado {
            border: 1px solid black;
            padding: 20px;
            text-align: center;
            margin: 0 auto;
            width: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .text-red {
            color: red;
        }
        .text-black {
            color: black;
        }
    </style>
</head>
<body>
<h1 class="centralizado">Relatório de Análises</h1>

<div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
<img  src="{{ public_path('images/ufob.png') }}" alt="Logo" style="width: 200px;">

    @if($progressao)
    <div class="centralizado">

        <h2>Dados da Progressão</h2>
        <p>Docente: {{ $nomeProfessor }}</p>
        <p>Professor ID: {{ $progressao->professor_id }}</p>
        <p>Nome da Progressão: {{ $progressao->nome_progressao }}</p>
        <p>Data Inicial do Interstício: {{ $progressao->intersticio_data_inicial }}</p>
        <p>Data Final do Interstício: {{ $progressao->intersticio_data_final }}</p>
        <p>Classe: {{ $progressao->classe }}</p>
        <p>Regime: {{ $progressao->regime }}</p>
        <p>Nível: {{ $progressao->nivel }}</p>
        <p>Data da Última Progressão: {{ $progressao->data_ultima_progressao }}</p>
    </div>
    @endif

<!-- Inicio Tabela Análises Progressão-->
@php
    $totalQuantidade = 0;
    $totalPontuacao = 0;
    $totalPontuacaoAvaliador = 0; // Adiciona variável para totalizar pontos avaliador
    $grupoPontuacoes = [];
@endphp

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>

@foreach($grupos as $grupo)
<h2>Grupo de Progressão: {{ $grupo->nome_grupo_progressao }}</h2>
<p>Data Inicial do Interstício: {{ $progressao->intersticio_data_inicial }}</p>
<table>
    <thead>
        <tr>
            <th>Referência</th>
            <th>Quantidade</th>
            <th>Pontuação</th>
            <th>Pontos Avaliador</th> <!-- Nova coluna -->
             <th>Data Inicial</th>
            <th>Data Final</th>
           <!-- <th>Observação</th> -->
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php
            $grupoQuantidade = 0;
            $grupoPontuacao = 0;
            $grupoPontuacaoAvaliador = 0; // Adiciona variável para totalizar pontos avaliador do grupo
            $hasEarlierDate = false;
        @endphp
        @foreach($grupo->ngCertificadosProgressao as $certificado)
            @php
                $isEarlier = strtotime($certificado->data_inicial) < strtotime($progressao->intersticio_data_inicial);
                if ($isEarlier) {
                    $hasEarlierDate = true;
                }
            @endphp
            <tr>
                <td>{{ $certificado->referencia }}</td>
                <td>{{ $certificado->quantidade }}</td>
                <td>{{ $certificado->pontuacao }}</td>
                <td>{{ $certificado->pontuacao_avaliador }}</td> <!-- Nova coluna -->
                <td class="{{ $isEarlier ? 'text-red' : 'text-black' }}">{{ $certificado->data_inicial }}</td>
                <td>{{ $certificado->data_final }}</td>
               <!-- <td>{{ $certificado->observacao }}</td> -->
                <td>{{ $certificado->status }}</td>
            </tr>
            @php
                $grupoQuantidade += $certificado->quantidade;
                $grupoPontuacao += $certificado->pontuacao;
                $grupoPontuacaoAvaliador += $certificado->pontuacao_avaliador; // Soma pontos avaliador do grupo
            @endphp
        @endforeach
        <tr>
            <th>Total do Grupo</th>
            <td>{{ $grupoQuantidade }}</td>
            <td>{{ $grupoPontuacao }}</td>
            <td>{{ $grupoPontuacaoAvaliador }}</td> <!-- Total pontos avaliador do grupo -->
            <td colspan="4"></td>
        </tr>
    </tbody>
</table>
@if ($hasEarlierDate)
    <p style="color: red;">Nota: Algumas datas de início dos certificados são anteriores à data inicial do interstício.</p>
@endif

@php
    $totalQuantidade += $grupoQuantidade;
    $totalPontuacao += $grupoPontuacao;
    $totalPontuacaoAvaliador += $grupoPontuacaoAvaliador; // Soma pontos avaliador total
    $grupoPontuacoes[] = $grupoPontuacao; // Adiciona pontuação do grupo ao array
@endphp
<br>
@endforeach
<!-- Fim Tabela Análises Progressão-->


<!-- Inicio Sumatória de Todos os Grupos-->

<h2>Sumatória de Todos os Grupos</h2>
<table>
    <thead>
        <tr>
            <th>Atividade</th>
            <th>Total de Quantidade</th>
            <th>Total de Pontuação</th>
            <th>Total de Pontuação Avaliador</th> <!-- Nova coluna -->
            <th>Pontuaçãos por Grupos Solicitadas</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Todos os Grupos</td>
            <td>{{ $totalQuantidade }}</td>
            <td>{{ $totalPontuacao }}</td>
            <td>{{ $totalPontuacaoAvaliadorController }}</td> <!-- Total pontos avaliador -->
            <td>
            @foreach($grupos as $index => $grupo)
                        {{ $grupo->nome_grupo_progressao }}: {{ $grupoPontuacoes[$index] }}<br>
            @endforeach
            </td>
        </tr>                                               
        <tr>
            <td colspan="4"><strong>Total Geral</strong></td>totalPontuacaoAvaliador
            <td>(Professor:<strong>{{ $totalPontuacao }}</strong>) (Avaliador: <strong>{{ $totalPontuacaoAvaliadorController }}</strong>)</td>
        </tr>
    </tbody>
</table>

<!-- <p>No total, foram solicitadas {{ $totalPontuacao }} horas. A pontuação total aprovada pelo avaliador foi de {{ $totalPontuacaoAvaliador }} horas, sendo a diferença de 
    @php
        $diferenca = $totalPontuacaoAvaliador - $totalPontuacao;
        $corDiferenca = $diferenca < 0 ? 'red' : 'green';
    @endphp
    <span style="color: {{ $corDiferenca }};">{{ $diferenca }}</span> horas.
</p>
<p>A pontuação detalhada por grupo será apresentada na tabela abaixo:</p>

FIM Sumatória de Todos os Grupos-->


<!-- Inicio Detalhamentos Certificados Reijeitados-->

<h2>Detalhamentos Certificados Aprovados e Reijeitados</h2>
<p>No total, foram solicitadas {{ $totalPontuacao }} horas. A pontuação total aprovada pelo avaliador foi de 
    @php
        $totalPontuacaoAvaliadorFiltrada = 0;
        $certificadosRejeitados = 0;
        foreach ($grupos as $grupo) {
            foreach ($grupo->ngCertificadosProgressao as $certificado) {
                if ($certificado->status != 'Rejeitada' && $certificado->status != 'Pendente') {
                    $totalPontuacaoAvaliadorFiltrada += $certificado->pontuacao_avaliador;
                } else {
                    $certificadosRejeitados += $certificado->pontuacao_avaliador;
                }
            }
        }
        $diferenca = $totalPontuacaoAvaliadorFiltrada - $totalPontuacao;
        $corDiferenca = $diferenca < 0 ? 'red' : 'green';
    @endphp
    {{ $totalPontuacaoAvaliadorFiltrada }} horas, sendo a diferença de 
    <span style="color: {{ $corDiferenca }};">{{ $diferenca }}</span> horas.
</p>
<p>Os certificados rejeitados totalizam <span style="color: red;">{{ $certificadosRejeitados }}</span> horas.</p>
<p>A pontuação detalhada por grupo será apresentada na tabela abaixo:</p>

<table>
    <thead>
        <tr>
            <th>Nome do Certificado</th>
            <th>Pontuação</th>
            <th>Pontuação Avaliador</th>
            <th>Observações do Avaliador</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @php
        $totalPontuacaoCertificados = 0;
        $totalPontuacaoAvaliadorCertificados = 0;
        $certificadosRejeitados = 0;
        $certificadosAprovados = 0;
        $certificadosEmAnalise = 0;
    @endphp
    @foreach($grupos as $grupo)
        @foreach($grupo->ngCertificadosProgressao as $certificado)
            @if($certificado->status != 'Rejeitada')
                <tr>
                    <td>{{ $certificado->nome_certificado }}</td>
                    <td>{{ $certificado->pontuacao }}</td>
                    <td>{{ $certificado->pontuacao_avaliador }}</td>
                    <td>{{ $certificado->observacao }}</td>
                    <td style="color: 
                            @if($certificado->status == 'Aprovado')
                                green
                            @elseif($certificado->status == 'Pendente')
                                orange
                            @else
                                red
                            @endif
                        ;">
                            {{ $certificado->status }}
                        </td>                </tr>
                @php
                    $totalPontuacaoCertificados += $certificado->pontuacao;
                    $totalPontuacaoAvaliadorCertificados += $certificado->pontuacao_avaliador;
                    if ($certificado->status == 'Aprovado') {
                        $certificadosAprovados++;
                    } elseif ($certificado->status == 'Pendente') {
                        $certificadosEmAnalise++;
                    }
                @endphp
            @else
                @php
                    $certificadosRejeitados++;
                @endphp
            @endif
        @endforeach
    @endforeach
    <tr>
        <td><strong>Total</strong></td>
        <td><strong>{{ $totalPontuacaoCertificados }}</strong></td>
        <td><strong>{{ $totalPontuacaoAvaliadorCertificados }}</strong></td>
        <td colspan="2"></td>
    </tr>
    </tbody>
</table>

<!-- Tabela de Certificados Rejeitados -->
<h2>Certificados Rejeitados</h2>
<table>
    <thead>
        <tr style="color: red;">
            <th>Nome do Certificado</th>
            <th>Pontuação</th>
            <th>Pontuação Avaliador</th>
            <th>Observações do Avaliador</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grupos as $grupo)
            @foreach($grupo->ngCertificadosProgressao as $certificado)
                @if($certificado->status == 'Rejeitada')
                    <tr style="color: red;">
                        <td>{{ $certificado->nome_certificado }}</td>
                        <td>{{ $certificado->pontuacao }}</td>
                        <td>{{ $certificado->pontuacao_avaliador }}</td>
                        <td>{{ $certificado->observacao }}</td>
                        <td>{{ $certificado->status }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>

<!-- FIM Tabela de Certificados Rejeitados -->

<p>No período de progressão, foram rejeitados {{ $certificadosRejeitados }} certificados, aprovados {{ $certificadosAprovados }} certificados, e {{ $certificadosEmAnalise }} certificados ainda estão em análise. 
    A pontuação final, considerando o valor do avaliador, é de: 
    <h2> Pontuação Deferida Avaliador: <strong>{{ $totalPontuacaoAvaliadorController}}.</h2></strong></p>


<!-- FIM Tabela de Certificados Rejeitados -->




</div>
</body>
</html>


