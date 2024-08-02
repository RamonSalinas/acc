<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Análises</title>
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
    </style>
</head>
<body>
<h1>Relatório de Análises</h1>
@php
    $totalQuantidade = 0;
    $totalPontuacao = 0;
    $grupoPontuacoes = [];
@endphp
@foreach($grupos as $grupo)
    <h2>Grupo de Progressão: {{ $grupo->nome_grupo_progressao }}</h2>
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
            @endphp
            @foreach($grupo->ngCertificadosProgressao as $certificado)
                <tr>
                    <td>{{ $certificado->referencia }}</td>
                    <td>{{ $certificado->quantidade }}</td>
                    <td>{{ $certificado->pontuacao }}</td>
                    <td>{{ $certificado->data_inicial }}</td>
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
</body>
</html>




