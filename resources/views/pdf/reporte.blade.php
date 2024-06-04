<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatório de Certificados</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .container {
      padding: 20px;
    }
    h1, h2 {
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 8px 12px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #f4f4f4;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Relatório de Certificados</h1>

    <!-- Informações do Curso -->
    <h2>Informações do Curso</h2>
    <p><strong>Nome do Curso:</strong> {{ $curso->nome_curso }}</p>
    <p><strong>Carga Horária ACC:</strong> {{ $curso->carga_horaria_ACC }}</p>
    <p><strong>Carga Horária Extensão:</strong> {{ $curso->carga_horaria_Extensao }}</p>

    <h2>Total de Certificados: {{ $totalCertificados }}</h2>
    
    <h2>Contagem de Tipos de Atividades</h2>
    <table>
      <thead>
        <tr>
          <th>Nome da Atividade</th>
          <th>Número do Grupo de Atividades</th>
          <th>Quantidade</th>
          <th>Soma das Horas ACC</th>
          <th>Percentual Máximo</th>
          <th>Comparação</th>
        </tr>
      </thead>
      <tbody>
        @foreach($atividadeCounts as $data)
          @php
            $atividade = $data['atividade'];
          @endphp
          <tr>
            <td>{{ $atividade->nome_atividade ?? 'Desconhecido' }}</td>
            <td>{{ $atividade->grupo_atividades ?? 'N/A' }}</td>
            <td>{{ $data['count'] }}</td>
            <td>{{ $data['horas_acc_sum'] }}</td>
            <td>{{ $data['percentual_maximo'] }}%</td>
            <td>{{ $data['comparacao'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Resumo das Horas ACC -->
    <h2>Resumo das Horas ACC</h2>
    <p><strong>Soma Total das Horas ACC:</strong> {{ $totalHorasACC }}</p>
    <p>{{ $necessarioACC }}</p>

    <!-- Resumo das Horas de Extensão -->
    <h2>Resumo das Horas de Extensão</h2>
    <p><strong>Soma Total das Horas de Extensão:</strong> {{ $totalHorasExtensao }}</p>
    <p>{{ $necessarioExtensao }}</p>

    <h2>Detalhes dos Certificados</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome Certificado</th>
          <th>Atividade</th>
          <th>Usuário</th>
          <th>Data Início</th>
          <th>Data Final</th>
        </tr>
      </thead>
      <tbody>
        @foreach($certificados as $certificado)
          <tr>
            <td>{{ $certificado->id }}</td>
            <td>{{ $certificado->nome_certificado }}</td>
            <td>{{ $certificado->ngAtividade->nome_atividade ?? 'N/A' }}</td>
            <td>{{ $certificado->user->name ?? 'N/A' }}</td>
            <td>{{ $certificado->data_inicio }}</td>
            <td>{{ $certificado->data_final }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
