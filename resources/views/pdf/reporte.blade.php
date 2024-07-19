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
    <p><strong>Discente:</strong> {{ $discente->name ?? 'N/A' }}</p>
    <p><strong>Nome do Curso:</strong> {{ $curso->nome_curso }}</p>
    <p><strong>Carga Horária ACC:</strong> {{ $curso->carga_horaria_ACC }}</p>
    <p><strong>Carga Horária Extensão:</strong> {{ $curso->carga_horaria_Extensao }}</p>


    <!-- Resumo das Horas ACC -->

<div style="border: px solid #ccc; padding: 20px; margin-bottom: 20px;">
    <h2>Horas ACC</h2>
    <p><strong>Soma Total das Horas ACC:</strong> {{ $totalHorasACC }}</p>
    <p>{{ $necessarioACC }}</p>

    <!-- Resumo das Horas de Extensão -->
    <h2>Horas de Extensão</h2>
    <p><strong>Soma Total das Horas de Extensão:</strong> {{ $totalHorasExtensao }}</p>
    <p>{{ $necessarioExtensao }}</p>
</div>

    <h2>Total de Certificados: {{ $totalCertificados }}</h2>



    
    <h2>Revisão Automática das Atividades Submetidas com Algoritmo de Avaliação Inteligente por grupo geral de atividades</h2>
    <table>
      <thead>
        <tr>
          <th>Grupo de Atividades</th>
          <th>Nome da Atividade</th>
          <th>Quantidade</th>
          <th>Horas acumulados por grupos e atividades</th>
      <!--<th>Horas Não Consideradas</th> 
          <th>Percentual Máximo</th>  -->
          <th>Análises</th>
        </tr>
      </thead>
      <tbody>
        @foreach($atividadeCounts as $data)
          @php
            $atividade = $data['atividade'];
          @endphp
          <tr>
            <td>{{$atividade->grupo->nome_grupo }}</td>
            <td>{{ $atividade->nome_atividade ?? 'Desconhecido' }}</td>
            <td>{{ $data['count'] }}</td>
            <td>{{ $data['horas_acc_sum'] }}</td>
          <!--   <td>{{ $data['horasExcedentes'] }}</td>
            <td>{{ $data['percentual_maximo'] }}%</td>  -->
            <td>{{ $data['comparacao'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

   <!-- Resumo das Horas ACC -->

   <h2>Análises grupo geral de atividades</h2>

<p><strong>Soma Total das Horas de todas as atividades</strong> {{ $totalHorasACC }}</p>



<h2>Relátorio atividades que ultrapassaram os máximos dos baremas e que não foram contepladas </h2>
    <table border="1">
        <thead>
            <tr>
            <th>ID</th>
                <th>Nome Certificado</th>
                <th>Horas Excedentes</th>
            </tr>
        </thead>
        <tbody>
        @foreach($certificados as $certificado) <!-- Supondo que a variável se chame $certificados -->
            <tr>
                <td>{{ $certificado->id }}</td> <!-- ID do certificado -->
                <td>{{ $certificado->nome_certificado }}</td> <!-- Nome do certificado -->
                <td>{{ $atividadeCounts[$certificado->id_tipo_atividade]['horasExcedentes'] ?? 'N/A' }}</td>
                </tr>
        @endforeach
        </tbody>
    </table>

<p>{{ $necessarioACC }}</p>

    <!-- Detalhes das Atividades Registradas por Quantidade -->


    <h2>Detalhes das Atividades Registradas por Quantidade</h2>
<table>
  <thead>
    <tr>
      <th>Nome Certificado</th>
      <th>Atividade</th>
      <th>Horas Registradas</th>
      <th>Horas Máxima por Grupo</th>
      <th>Grupo</th> <!-- Coluna existente para o grupo -->
      <th>Percentual Máximo por Atividade</th> <!-- Nova coluna para percentual máximo -->
      <th>Horas Permitidas</th>
      <th>Detalhes</th>

    </tr>
  </thead>
  <tbody>
@php
$horasPorAtividade = [];
$somaHorasACC = 0;
$excedeuMax = false;
$excedeuMax2 = false;
$grupoAtual = '';
@endphp

@foreach($certificados as $certificado)
  @php
  $idAtividade = $certificado->ngAtividade->id;
  $percentualMaximo = $certificado->ngAtividade->percentual_maximo;
  $grupoAtividade = $certificado->ngAtividade->grupo_atividades;

  // Inicializa o grupo se necessário
  if ($grupoAtual != $grupoAtividade) {
    $grupoAtual = $grupoAtividade;
    $horasPorAtividade = []; // Reinicia a contagem para o novo grupo
  }

  // Calcula o máximo de horas permitidas para esta atividade
  $maxHorasPermitidas = ($curso->carga_horaria_ACC * $percentualMaximo) / 100;

  // Soma as horas por atividade
  if (!isset($horasPorAtividade[$idAtividade])) {
    $horasPorAtividade[$idAtividade] = 0;
  }
  $horasPorAtividade[$idAtividade] += $certificado->horas_ACC;

  // Verifica se a soma total de horas ACC não ultrapassa o valor de carga_horaria_ACC
  $somaHorasACC += $certificado->horas_ACC;
  $horasExcedidas = $somaHorasACC - $curso->carga_horaria_ACC;
  @endphp
  <tr>
    <td>{{ $maxHorasPermitidas }}</td>
    <td>{{ $certificado->ngAtividade->nome_atividade ?? 'N/A' }}</td>
    <td>{{ $certificado->horas_ACC }}</td>
    <td>{{ $curso->carga_horaria_ACC }}</td>
    <td>{{ $grupoAtividade }}</td>
    <td>{{ $percentualMaximo ?? 'N/A' }}%</td>
    <td>
      @if($horasPorAtividade[$idAtividade] <= $maxHorasPermitidas)
        {{ $horasPorAtividade[$idAtividade] }}
      @else
        Ultrapassou o valor máximo permitido
      @endif
    </td>
    <td>
      @if($somaHorasACC <= $curso->carga_horaria_ACC)
        {{ $somaHorasACC }}
      @elseif(!$excedeuMax)
        @php $excedeuMax = true; @endphp
        {{ $horasExcedidas }} Horas excedidas e não consideradas. Horas ACC Completas
      @elseif(!$excedeuMax2)
        @php $excedeuMax2 = true; @endphp
        Nenhuma hora do certificado contemplada. Horas ACC completas
      @endif
    </td>
  </tr>
@endforeach
  </tbody>
</table>





<h2>Consolidação Horas</h2>
<table>
  <thead>
    <tr>
      <th>Grupo de Atividades</th>
    </tr>
  </thead>
  <tbody>
  @php
$horasPorAtividade = [];
$somaHorasACC = 0;
$excedeuMax = false;
$excedeuMax2 = false;
$grupoAtual = '';
$totalHorasRegistradas = 0;
$totalHorasPermitidas = 0;
@endphp

@foreach($certificados as $certificado)
  @php
  $idAtividade = $certificado->ngAtividade->id;
  $percentualMaximo = $certificado->ngAtividade->percentual_maximo;
  $grupoAtividade = $certificado->ngAtividade->grupo_atividades;

  if ($grupoAtual != '' && $grupoAtual != $grupoAtividade) {
    // Exibe o resumo do grupo anterior
    echo "<tr><td colspan='3'>Resumo do Grupo $grupoAtual</td><td>$totalHorasRegistradas</td><td>$totalHorasPermitidas</td></tr>";

    // Reinicia as somas para o novo grupo
    $totalHorasRegistradas = 0;
    $totalHorasPermitidas = 0;
    $horasPorAtividade = [];
  }

  $grupoAtual = $grupoAtividade;

  $maxHorasPermitidas = ($curso->carga_horaria_ACC * $percentualMaximo) / 100;
  if (!isset($horasPorAtividade[$idAtividade])) {
    $horasPorAtividade[$idAtividade] = 0;
  }
  $horasPorAtividade[$idAtividade] += $certificado->horas_ACC;

  $somaHorasACC += $certificado->horas_ACC;
  $horasExcedidas = $somaHorasACC - $curso->carga_horaria_ACC;

  // Acumula as somas para o resumo final
  $totalHorasRegistradas += $certificado->horas_ACC;
  $totalHorasPermitidas += min($horasPorAtividade[$idAtividade], $maxHorasPermitidas);
  @endphp
  <tr>
    <!-- Células da tabela -->
  </tr>
@endforeach

@if($grupoAtual != '')
  <!-- Exibe o resumo do último grupo -->
  <tr><td colspan='3'>Resumo do Grupo {{ $grupoAtual }}</td><td>{{ $totalHorasRegistradas }}</td><td>{{ $totalHorasPermitidas }}</td></tr>
@endif

<!-- Exibe o resumo final -->
<tr><td colspan='3'><strong>Total Geral</strong></td><td>{{ $totalHorasRegistradas }}</td><td>{{ $totalHorasPermitidas }}</td></tr>
  </tbody>
</table>











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
      <th>Horas Registradas</th>
      <th>Horas ACC MAX</th>
      <th>Horas ACC Sumada</th>
    </tr>
  </thead>
  <tbody>
    @php
      $somaHorasACC = 0;
      $excedeuMax = false;
      $excedeuMax2 = false;
    @endphp
    @foreach($certificados as $certificado)
      @php
        $somaHorasACC += $certificado->horas_ACC;
        $horasExcedidas = $somaHorasACC - $curso->carga_horaria_ACC;
      @endphp
      <tr>
        <td>{{ $certificado->id }}</td>
        <td>{{ $certificado->nome_certificado }}</td>
        <td>{{ $certificado->ngAtividade->nome_atividade ?? 'N/A' }}</td>
        <td>{{ $certificado->horas_ACC }}</td>
        <td>{{ $curso->carga_horaria_ACC }}</td>
        <td>
          @if($somaHorasACC <= $curso->carga_horaria_ACC)
            {{ $somaHorasACC }}
          @elseif(!$excedeuMax)
            @php $excedeuMax = true; @endphp
            {{ $horasExcedidas }} Horas exedidas e não consideradas. Horas ACC Completas
          @elseif(!$excedeuMax2)
            @php $excedeuMax2 = true; @endphp
            Nenhuma hora do certificado contempladas Horas ACC completas
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

  </div>
</body>
</html>

<p><strong>Carga Horária Maxima:</strong> {{ $curso->carga_horaria_ACC }}</p>


<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Atividade</th>
      <th>Horas Registradas</th>
      <th>Horas Máxima por Grupo</th>
      <th>Grupo</th>
      <th>Percentual Máximo por Atividade</th>
      <th>Horas Permitidas</th>
      <th>Horas Aceitas</th>
      <th>Analises</th>
    </tr>
  </thead>
  <tbody>
@php
$totalHorasRegistradas = 0;
$totalHorasPermitidas = 0;
$totalHorasAceitas = 0;
$extrapolou = 0;
$horasPorAtividade = [];
$somaHorasACC = 0;
$excedeuMax = false;
$grupoAtual = '';

@endphp

@foreach($certificados as $certificado)
  @php
  $idAtividade = $certificado->ngAtividade->id;
  $percentualMaximo = $certificado->ngAtividade->percentual_maximo;
  $horasRegistradas = $certificado->horas_ACC;
  $horasAceitas = $horasRegistradas; // Inicialmente, assumimos que todas as horas são aceitas

  $grupoAtividade = $certificado->ngAtividade->grupo_atividades;

  if ($grupoAtual != $grupoAtividade) {
    $grupoAtual = $grupoAtividade;
    $horasPorAtividade = [];
  }

  $maxHorasPermitidas = ($curso->carga_horaria_ACC * $percentualMaximo) / 100;


  if (!isset($horasPorAtividade[$idAtividade])) {
    $horasPorAtividade[$idAtividade] = 0;
  }
  $horasPorAtividade[$idAtividade] += $certificado->horas_ACC;

  $somaHorasACC += $certificado->horas_ACC;
  $horasExcedidas = $somaHorasACC - $curso->carga_horaria_ACC;

  $analise = '';
  $horasRestantes = 0;
  $horasNaoPermitidas = 0;

  if($idAtividade == 10) {
    $analise = 'Atividade de extensão registrada adequadamente';
  } else {
  if ($somaHorasACC <= $curso->carga_horaria_ACC) {
    if ($horasPorAtividade[$idAtividade] <= $maxHorasPermitidas) {
      $horasRestantes = $maxHorasPermitidas - $horasPorAtividade[$idAtividade];
      $analise = 'Ainda pode registrar ' . $horasRestantes . ' horas nesta atividade';

    } else{
      $horasExtrapoladas = $horasPorAtividade[$idAtividade] - $maxHorasPermitidas;
      $horasNaoPermitidas = $horasPorAtividade[$idAtividade] - $maxHorasPermitidas;
      $extrapolou += $horasExtrapoladas;
      $analise = 'Ultrapassou  '.$horasNaoPermitidas.' horas  nesta atividade ';
      }

  }elseif ($horasPorAtividade[$idAtividade] <= $maxHorasPermitidas) {

    $horasRestantes = $maxHorasPermitidas - $horasPorAtividade[$idAtividade]; //Horas Permitidas 

    $analise = 'ACC Alcançadas, ainda pode registrar mais  '.$horasRestantes.' horas nesta atividade';

  }
  else {
    $analise = 'ACC Cumpridas e Ultrapassou as horas permitidas nesta atividade ';
    $horasExtrapoladas = $somaHorasACC - $curso->carga_horaria_ACC;
    $horasNaoPermitidas = $somaHorasACC - $curso->carga_horaria_ACC;
    $extrapolou += $horasExtrapoladas;
    $horasAceitas = $maxHorasPermitidas - ($horasPorAtividade[$idAtividade] - $horasRegistradas); // Ajusta as horas aceitas para não incluir as horas extrapoladas

  }
}
  // Atualiza os totais
  $totalHorasRegistradas += $certificado->horas_ACC;
  $totalHorasPermitidas += $maxHorasPermitidas;
  $totalHorasAceitas += min($certificado->horas_ACC, $maxHorasPermitidas);
  @endphp
  <tr>
    <td>{{ $certificado->id ?? 'N/A' }}</td>
    <td>{{ $certificado->nome_certificado ?? 'N/A' }}</td>
    <td>{{ $certificado->horas_ACC }}</td>
    <td>{{ $curso->carga_horaria_ACC }}</td>
    <td>{{ $grupoAtividade }}</td>
    <td>{{ $percentualMaximo ?? 'N/A' }}%</td>
    <td>{{ $horasRestantes > 0 ? $horasRestantes : 'N/A' }}</td>
    <td>{{ $horasAceitas < 0 ? 0 : $horasAceitas }}</td>
    <td>{{ $analise}}</td>
  </tr>
@endforeach
  <tr>
    <td colspan="2">Total</td>
    <td>{{ $totalHorasRegistradas }}</td>
    <td></td>
    <td></td>
    <td></td>
    <td>{{ $totalHorasPermitidas }}</td>
    <td>{{ $totalHorasAceitas }}</td>
    <td></td>
  </tr>
  </tbody>
</table>