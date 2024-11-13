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
      width: 95%;
      border-collapse: collapse;
      margin-left: auto;
      margin-right: auto;
      font-size: 14px;tr:hover {
  background-color: #f5f5f5;
}
      margin-top: 15px;
    }
    th, td {
      padding: 8px 12px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background-color: #4F6D7A;
    }.resumo-container {
    margin-top: 10px;
    margin-left: auto;
    margin-right: auto;
    max-width: 80%; /* Ajuste conforme necessário */
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Adiciona sombra para destacar o quadro */
    padding: 20px;
    border-radius: 10px; /* Bordas arredondadas */
}
.resumo-column p {
    margin-top: 1px; /* Reduz o espaço acima de cada parágrafo */
    margin-bottom: 1px; /* Reduz o espaço abaixo de cada parágrafo */
  }

  .resumo-column h3, .resumo-column p {
    margin-top: 5px; /* Reduz o espaço acima de cada elemento */
    margin-bottom: 5px; /* Reduz o espaço abaixo de cada elemento */
    font-size: 14px; /* Diminui o tamanho da fonte */
  }

.resumo-column {
    width: 45%;
    padding: 10px; /* Reduz o preenchimento dentro de cada coluna */

}

@media (max-width: 768px) {
    .resumo-container div {
        width: 100%;
    }
    .resumo-container {
      margin-top: 2px; /* Reduz o espaço acima de cada parágrafo */
      margin-bottom: 3px; /* Reduz o espaço abaixo de cada parágrafo */

        flex-direction: column;
        align-items: center;
    }

    .aprovado {
      font-size: 12px; /* Diminui o tamanho da fonte */

  background-color: green;
  color: white;
}

.rejeitado {
  font-size: 12px; /* Diminui o tamanho da fonte */
  background-color: red;
  color: white;
}
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






    <div style="border: 1px solid #ccc; padding: 20px; margin-bottom: 20px;">
  <div class="resumo-container">
      <h2 style="text-align: center;">Análise Detalhada de Predição de Atividades Complementares</h2>
      <p style="text-align: center;">Aqui está uma análise detalhada da predição das horas registradas, da predição de aprovação automatizada e dos certificados processados.</p>
      <p style="text-align: center;">Este relatório fornece uma visão abrangente das horas registradas pelos alunos, avaliando a conformidade com os requisitos do curso. Além disso, apresenta uma análise automatizada da aprovação dos certificados submetidos, destacando aqueles que atendem aos critérios estabelecidos. Abaixo estão os detalhes sobre o processamento dos certificados e a previsão das horas acumuladas para cada atividade, considerando a quantidade máxima permitida de registro de horas ACC e extensão.</p>
      <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
          <thead>
              <tr>
                  <th style="border: 1px solid #ccc; padding: 8px;">ID</th>
                  <th style="border: 1px solid #ccc; padding: 8px;">Nome</th>
                  <th style="border: 1px solid #ccc; padding: 8px;">Grupo</th>
                  <th style="border: 1px solid #ccc; padding: 8px;">Atividade</th>
                  <th style="border: 1px solid #ccc; padding: 8px;">Horas Registradas</th>
                  <th style="border: 1px solid #ccc; padding: 8px;">Horas Aceitas</th>
                  <th style="border: 1px solid #ccc; padding: 8px;">Horas Extrapoladas</th>
                  <th style="border: 1px solid #ccc; padding: 8px;">Análises</th>
              </tr>
          </thead>
          <tbody>
              <!-- Dados da tabela devem ser inseridos aqui -->
          </tbody>
      </table>
      <p style="text-align: center; margin-top: 20px;">A tabela acima descreve as seguintes colunas:</p>
      <ul style="text-align: center; list-style-type: none; padding: 0;">
          <li><strong>Nome:</strong> Nome do certificado registrado.</li>
          <li><strong>Grupo:</strong> Grupo no qual foi registrado o certificado.</li>
          <li><strong>Atividade:</strong> Atividade na qual foi registrado o certificado.</li>
          <li><strong>Horas Registradas:</strong> Horas registradas pelo aluno.</li>
          <li><strong>Grupo:</strong> Grupo no qual foi registrado o certificado.</li>
          <li><strong>Horas Aceitas:</strong> Horas previstas pelo sistema que poderão ser aprovadas pelo orientador.</li>
          <li><strong>Horas Extrapoladas:</strong> Horas previstas pelo sistema que estão extrapolado  e que não serão contabilizadas</li>
          <li><strong>Análises:</strong> Análise do resultado e status das horas registradas e processadas usando o sistema de predição automatizado.</li>
          <li><<strong>
                <span style="display: inline-block; width: 10px; height: 10px; background-color: green; margin-right: 5px;"></span>
                Cor Verde:
            </strong>
            Registro aprovado pelo orientador.
            <strong>
                <span style="display: inline-block; width: 10px; height: 10px; background-color: red; margin-left: 15px; margin-right: 5px;"></span>
                Cor Vermelha:
            </strong>
            Registro rejeitado pelo orientador</li>

        </ul>
  </div>
</div>


<table>
  <thead>
  <tr>    
      <th>ID</th>
      <th>Nome</th>
      <th>Grupo</th>
      <th>Atividade</th>
      <th>Horas Registradas</th>
      <th>Horas Aceitas</th>
      <th>Horas Extrapoladas</th>
      <th>Análises</th>
    </tr>
  </thead>
  <tbody>

@php
$totalHorasRegistradas = 0;
$totalHorasPermitidas = 0;
$totalHorasAceitas = 0;
$totalHorasExtrapoladas = 0;
$extrapolou = 0;
$horasPorAtividade = [];
$somaHorasACC = 0;
$grupoAtual = '';
@endphp

@foreach($certificados->sortBy('created_at') as $certificado)
  @php
  $percentualMaximo = $certificado->ngAtividade->percentual_maximo;
  $horasRegistradas = $certificado->horas_ACC;
  $horasAceitas = $horasRegistradas;
  $grupoAtividade = $certificado->ngAtividade->grupo_atividades;

  $idAtividade = $certificado->ngAtividade->id;
  $maxHorasPermitidas = ($curso->carga_horaria_ACC * $percentualMaximo) / 100;

  if ($grupoAtual != $grupoAtividade) {
    $grupoAtual = $grupoAtividade;
    $horasPorAtividade = [];
  }

  if (!isset($horasPorAtividade[$idAtividade])) {
    $horasPorAtividade[$idAtividade] = ['registradas' => 0, 'extrapoladas' => 0];
  }

  $horasPorAtividade[$idAtividade]['registradas'] += $horasRegistradas;
  $somaHorasACC += $horasRegistradas;

  $analise = '';
  $horasRestantes = 0;
  $horasExtrapoladas = 0;

  if ($horasPorAtividade[$idAtividade]['registradas'] > $maxHorasPermitidas) {
    $horasExtrapoladas = $horasPorAtividade[$idAtividade]['registradas'] - $maxHorasPermitidas;
    $horasAceitas = max(0, $maxHorasPermitidas - ($horasPorAtividade[$idAtividade]['registradas'] - $horasRegistradas));
    $horasPorAtividade[$idAtividade]['extrapoladas'] = $horasExtrapoladas;
    $analise = 'Extrapolou ' . $horasExtrapoladas . ' horas nesta atividade';
  } else {
    $horasAceitas = $horasRegistradas;
    $horasRestantes = $maxHorasPermitidas - $horasPorAtividade[$idAtividade]['registradas'];
    $analise = 'Ainda pode registrar ' . $horasRestantes . ' horas nesta atividade';
  }

  if ($somaHorasACC > $curso->carga_horaria_ACC) {
   
    $analise = 'Horas ACC superadas';
  }

  $totalHorasRegistradas += $horasRegistradas;
  $totalHorasPermitidas += $maxHorasPermitidas;
  $totalHorasAceitas += $horasAceitas;

if($horasPorAtividade[$idAtividade]['extrapoladas'] > $horasRegistradas){//vALIDA SIM HORA EXTRAPOLADA E MAIOR PARA SALVAR NA TABELA BEM, MAS SALVA A SUMA TOTAL DA ATIVIDAD EXTRAPOLADAS PORQUE NO E NECESSAIRO VERDAD. 
 $horasPorAtividade[$idAtividade]['extrapoladas']= $horasRegistradas;
}

$totalHorasExtrapoladas += $horasPorAtividade[$idAtividade]['extrapoladas'];

  
 @endphp
  <tr class="{{ $certificado->type == 'Aprovada' ? 'aprovado' : ($certificado->type == 'Rejeitada' ? 'rejeitado' : '') }}">    
   
    <td>{{ $certificado->id ?? 'N/A' }}</td>
    <td>{{ $certificado->nome_certificado ?? 'N/A' }}</td>
    <td>{{ $grupoAtividade }}</td>
    <td>{{ $certificado->ngAtividade->nome_atividade ?? 'N/A' }}</td>
    <td>{{ $horasRegistradas }}</td>
    <td>{{ $horasAceitas }}</td>
    <td>{{ $horasPorAtividade[$idAtividade]['extrapoladas'] }}</td>
    <td>{{ $analise }}</td>
  </tr>
@endforeach
<tr>
  <td colspan="4">Total</td>
  <td>{{ $totalHorasRegistradas }}</td>
  <td>{{ $totalHorasAceitas }}</td>
  <td>{{ $totalHorasExtrapoladas }}</td>
  <td></td>
</tr>
</tbody>
</table>
<br>






@php
$certificadosPendentes = $certificados->where('type', 'Pendente')->count();
$certificadosAprovados = $certificados->where('type', 'Aprovada')->count();
$certificadosRejeitados = $certificados->where('type', 'Rejeitada')->count();
@endphp

<div style="border: px solid #ccc; padding: 20px; margin-bottom: 10px;">
  <div class="resumo-container">
      <h2 style="text-align: center;">Resumo das Atividades Complementares</h2>
      <p style="text-align: center;">Aqui está um resumo da predição das horas registradas, a predição de aprovação automatizada e dos certificados processados.</p>
      <p style="text-align: center;">Este relatório fornece uma visão geral das horas registradas pelos alunos, prevendo a sua conformidade com os requisitos do curso. Além disso, apresenta uma análise automatizada da aprovação dos certificados submetidos, destacando aqueles que atendem aos critérios estabelecidos. Abaixo estão os detalhes sobre o processamento dos certificados e a previsão das horas acumuladas para cada atividade.</p>      
      <div style="display: flex; justify-content: space-around; margin-top: 20px;">
           
                    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 5px;">

                              <div class="resumo-column">

                                    <h3 style="text-align: center;">Horas Registradas</h3>
                                    <p style="text-align: center;"><strong>Total Horas Registradas (ACC):</strong> {{ $totalHorasRegistradas }}</p>
                                </div>
                                <div class="resumo-column">
                                    <h3 style="text-align: center;">Horas Aprovadas</h3>
                                    <p style="text-align: center;"><strong>Total Horas Aprovadas:</strong> {{ $totalHorasAceitas }}</p>
                                    <p style="text-align: center;"><strong>Total Horas Extrapoladas:</strong> {{ $totalHorasExtrapoladas }}</p>
                                    <h3 style="text-align: center;">Certificados</h3>
                                    <p style="text-align: center;"><strong>Total Certificados Processados:</strong> {{ $certificados->count() }}</p>
                                    <p style="text-align: center;"><strong>Certificados Pendentes:</strong> {{ $certificadosPendentes }}</p>
                                    <p style="text-align: center;"><strong>Certificados Aprovados:</strong> {{ $certificadosAprovados }}</p>
                                    <p style="text-align: center;"><strong>Certificados Rejeitados:</strong> {{ $certificadosRejeitados }}</p>
                              </div>
              </div>
      </div>
  </div>
</div>


<br>


    
<h2>Revisão Automática dos Certificados Submetidos, Organizada por Grupo de Atividades com algoritmo de predição</h2>
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
    @php
      $totalQuantidade = 0;
      $totalHorasAcc = 0;
    @endphp
    @foreach($atividadeCounts as $data)
      @php
        $atividade = $data['atividade'];
        $totalQuantidade += $data['count'];
        $totalHorasAcc += $data['horas_acc_sum'];
        // Certifique-se de que horas_acc_sum está corretamente calculado para cada atividade
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
   <!-- <tr>
      <td colspan="2"><strong>Total</strong></td>
      <td><strong>{{ $totalQuantidade }}</strong></td>
      <td><strong>{{ $totalHorasAcc }}</strong></td>
      <td></td>
    </tr>-->
  </tbody>
</table>
   <!-- Resumo das Horas ACC -->


 
     <h2 style="text-align: center;">Resumo de Horas por Grupo de Atividade</h2>
      <p style="text-align: center;">Este resumo tem como intenção identificar em quais grupos estão mais concentradas as horas registradas, permitindo uma análise mais concreta.</p>
      <table>
  <thead>
    <tr>
      <th>Grupo de Atividades</th>
      <th>Horas Registradas</th>
    </tr>
  </thead>
  <tbody>
  @php
    $horasPorAtividade = [];
    $somaHorasACC = 0;
    $grupoAtual = '';
    $totalHorasRegistradas = 0;
  @endphp

  @foreach($certificados as $certificado)
    @php
      $idAtividade = $certificado->ngAtividade->id;
      $percentualMaximo = $certificado->ngAtividade->percentual_maximo;
      $grupoAtividade = $certificado->ngAtividade->grupo_atividades;

      if ($grupoAtual != '' && $grupoAtual != $grupoAtividade) {
        // Exibe o resumo do grupo anterior
        echo "<tr><td>Resumo do Grupo $grupoAtual</td><td>$totalHorasRegistradas</td></tr>";

        // Reinicia as somas para o novo grupo
        $totalHorasRegistradas = 0;
        $horasPorAtividade = [];
      }

      $grupoAtual = $grupoAtividade;

      $maxHorasPermitidas = ($curso->carga_horaria_ACC * $percentualMaximo) / 100;
      if (!isset($horasPorAtividade[$idAtividade])) {
        $horasPorAtividade[$idAtividade] = 0;
      }
      $horasPorAtividade[$idAtividade] += $certificado->horas_ACC;

      $somaHorasACC += $certificado->horas_ACC;

      // Acumula as somas para o resumo final
      $totalHorasRegistradas += $certificado->horas_ACC;
    @endphp
  @endforeach

  @if($grupoAtual != '')
    <!-- Exibe o resumo do último grupo -->
    <tr><td>Resumo do Grupo {{ $grupoAtual }}</td><td>{{ $totalHorasRegistradas }}</td></tr>
  @endif

  <!-- Exibe o resumo final -->
  <tr><td><strong>Total Geral</strong></td><td>{{ $somaHorasACC }}</td></tr>
  </tbody>
</table>


<<div style="border: 1px solid #ccc; padding: 20px; margin-top: 20px;">
  <div class="resumo-container">
      <p style="text-align: center; font-weight: bold;">Obrigado por usar o Sistema de Predição Inteligente de Horas ACC e Extensão da Universidade Federal do Oeste da Bahia.</p>
      <p style="text-align: center;">Esperamos que esta ferramenta tenha proporcionado uma experiência eficiente e útil na análise e gestão de suas atividades complementares e de extensão. Estamos sempre à disposição para melhorias e suporte. Continue contando com a Universidade para seu desenvolvimento acadêmico e profissional.</p>
  </div>
</div>

