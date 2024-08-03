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
        <p>Docente: {{ $usuario->name }}</p>
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

    @php
        $totalQuantidade = 0;
        $totalPontuacao = 0;
        $grupoPontuacoes = [];
    @endphp

    @foreach($grupos as $grupo)
    <h2>Grupo de Progressão: {{ $grupo->nome_grupo_progressao }}</h2>
    <p>Data Inicial do Interstício: {{ $progressao->intersticio_data_inicial }}</p>
    <table>
        <thead>
            <tr>
                <th>Referência</th>
                <th>Quantidade</th>
                <th>Pontuação</th>
                <th>Data Inicial</th>
                <th>Data Final</th>
                <th>Observação</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grupoQuantidade = 0;
                $grupoPontuacao = 0;
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
                    <td class="{{ $isEarlier ? 'text-red' : 'text-black' }}">{{ $certificado->data_inicial }}</td>
                    <td>{{ $certificado->data_final }}</td>
                    <td>{{ $certificado->observacao }}</td>
                    <td>{{ $certificado->status }}</td>
                </tr>
                @php
                    $grupoQuantidade += $certificado->quantidade;
                    $grupoPontuacao += $certificado->pontuacao;
                @endphp
            @endforeach
            <tr>
                <th>Total do Grupo</th>
                <td>{{ $grupoQuantidade }}</td>
                <td>{{ $grupoPontuacao }}</td>
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
        $grupoPontuacoes[] = $grupoPontuacao;
    @endphp
    <br>
    @endforeach

    <h2>Sumatória de Todos os Grupos</h2>
    <table>
        <thead>
            <tr>
                <th>Atividade</th>
                <th>Total de Quantidade</th>
                <th>Total de Pontuação</th>
                <th>Grupos e Pontuações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Todos os Grupos</td>
                <td>{{ $totalQuantidade }}</td>
                <td>{{ $totalPontuacao }}</td>
                <td>
                    @foreach($grupos as $index => $grupo)
                        {{ $grupo->nome_grupo_progressao }}: {{ $grupoPontuacoes[$index] }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="3"><strong>Total Geral</strong></td>
                <td><strong>{{ $totalPontuacao }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>