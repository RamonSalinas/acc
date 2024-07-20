Desejo atualizar a tabela Desejo atualizar a seguinte tabela  <p><strong>Carga Horária Maxima:</strong> {{ $curso->carga_horaria_ACC }}</p>


<h2>XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX</h2>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Atividade</th>
      <th>Horas Registradas</th>
      <th>Horas Máxima por Grupo</th>
      <th>Grupo</th> <!-- Coluna existente para o grupo -->
      <th>Percentual Máximo por Atividade</th> <!-- Nova coluna para percentual máximo -->
      <th>Horas Permitidas</th>
      <th>Analises</th>

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
    <td>{{ $certificado->id?? 'N/A'}}</td>
    <td>{{ $certificado->nome_certificado?? 'N/A' }}</td>
    <td>{{ $certificado->horas_ACC }}</td>
    <td>{{ $curso->carga_horaria_ACC }}</td>
    <td>{{ $grupoAtividade }}</td>
    <td>{{ $percentualMaximo ?? 'N/A' }}%</td>
    <td>
   Ajustar segundo a necessidade
    </td>
    <td>
      Ajustar segundo a necessidade
    </td>
  </tr>
@endforeach
  </tbody>
</table>
 para realizar as seguintes validações antes de adicionar um novo registro:

 . Organize os certificados para ser apresendados em ordem de criação
 . Crie uma columna chamada de horas Aceitas
 . Crie um columna chamada horas Extrapoladas

1. Verifique se a soma das horas do campo "Horas Registradas" é inferior às horas da "Carga Horária Máxima" do curso.
    - Se sim:
        2. Verifique se o ID da atividade registrada no certificado já foi registrado.
            - Se sim:
                a. Some o valor das "Horas Registradas" do registro anterior.
                
                
                . Verifique se o resultado dessa soma é menor que o valor da multiplicação do "Percentual Máximo por Atividade" pela "Carga Horária Máxima da atividade".

                
                    - Se sim:
                        i. Apresente a mensagem "Ainda pode registrar mais certificados nesta atividade" na coluna de Análises.
                        ii. Calcule o número de horas que ainda podem ser registradas usando a fórmula:
                            `Horas Restantes = (Percentual Máximo por Atividade * Carga Horária Máxima) - Soma das Horas Registradas`
                            Mostre o valor de dessa operação.   Se o valor de horas restantes é maior que o valor Carga Horária Máxima,  Apresente a mensagem "Alcanco as horas ACC" na coluna de Análises.
                    - Se não:
                        i. Apresente a mensagem "Extorou as horas permitidas nesta atividade" na coluna de Análises.
                        ii. Calcule quantas horas foram Extorou usando a fórmula:
                            `Horas Extrapoladas = Soma das Horas Registradas - (Percentual Máximo por Atividade * Carga Horária Máxima)-Extrapolou`
        
                        
                        
                        iii. Atualize a variável `Extrapolou` com o valor resultante da fórmula:
                            `Extrapolou = Horas Extrapoladas + Extrapolou`   
                            
                            
                            
                            No codigo acima estou tendo problema com os calculas da columna Horas Aceitas já que não comple em sua totalidade as necessidades requeridas.  Para isso desejo que veja a seguinte logica e o exemplo para que ajuste o codigo da minha tabela na columnas Horas Aceitas e adicionalmente preciso que crie uma columna chamada como horas extrapoladas para atender a necessidade.
                            
                             O valor de horas extrapoladas tem que ser salva por cada atividade com idactividade igual quando o registro for um idactividade que ainda não for colocado na tabela,  ele tem que iniciar uma nova conta de horas extrapoladas dessa atividade,  mas quando aparece na tabela com um idatividade já inicializado deve retornar com o valor de horas extrapoladas previamente registrado. Importante saber que tem um contador de Soma das Horas Registradas da atividade e uma Soma das Horas Registradas Geral que é usada para verificar sim as horas Carga Horária Máxima foi supera em caso positovo mostra a mensagem na columna analises horas ACC superadas e sim as  Soma das Horas Registradas da atividade supera o valor das (Percentual Máximo por Atividade * Carga Horária Máxima)  agregue a coolumna de analises a mensgame horas maxima da atividade superada. Segundo o exemplo deve registrar os valores corretos na comumna horas aceitas e horas extrpoladas. 
                            Vamos pensar que vamos a processar o segundo registro da tabela.   O registro previo tinha registrado 20 no idativiade igual a 1. O seguindo registro também é idatividade igual a 1 tem as seguintes variaveis: 
                            Horas registradas =  6
                            Percentual Máximo por Atividade = 50 porcento
                            Carga Horária Máxima= 50
                            (Percentual Máximo por Atividade * Carga Horária Máxima)=  25 horas
                            Soma das Horas Registradas Atividade = 20 de registro anterior + Horas registradas
                            Soma das Horas Registradas Geral =  26 
                            `Horas Extrapoladas = 26 - 25 - 0
                            Extrapoladas = 1
 
Então neste certifcado  foi extrapolada uma 1,   e requero que o registre na columna horas extrapoladas 1  e na columna horas Aceita o valor de 5(o valor de de Horas regitradas - Horas Extrapoladas).  como Soma das Horas Registradas Atividade >  (Percentual Máximo por Atividade * Carga Horária Máxima) e mostre ena columna analises  "Alcanço el máximo nesta atividade" entanto sim  Soma das Horas Registradas Geral < que Carga Horária Máxima. Mostre também na columna análises a mensagem "ACC  Não cumpridas" e sim Soma das Horas Registradas Geral > que Carga Horária Máxima a mensagem "ACC  SIM cumpridas".


o seguinte cetificado idatividade = 1   por tanto  e as horas registradas são 7 segundo a logica projetada,  Horas extrapoladas = (33 - 25 - 1.  Horas extrapoladas = 7;  Por tanto na columna  de horas extrapoladas é o número 7  e na columna horas aceitas 0. 

No seguinte certificado o idatividade = 4  por tanto a Soma das Horas Registradas dessa atividade = 0 mas a Soma das Horas Registradas Geral = 33, este registro no campo de Horas Registrada agrega o valor de 30 e (Percentual Máximo por Atividade * Carga Horária Máxima)=  25 horas
 fazendo a logica adequado deve registrar o valor de  na columna Horas Aceitas 25, com a mensagem que ultrapolou as horas da atividade  o valor de  na columna horas Extrapolado 5 e na columna análises mensagem ACC superada Porque a sumatorioa das Horas Registradas Geral debe ser com horas Aceitas por tanto.  33+25 = 58 e Registradas Geral>Carga Horária Máxima.  o valor de Horas Registradas dessa atividade      30                       `Horas Extrapoladas = 26 - 25 - 0



certificado 1    Horas Aceitas Horas Extrapoladas 






o novo registro  e tem com Horas registradas =  30
Percentual Máximo por Atividade = 50 porcento
Carga Horária Máxima= 50
 (Percentual Máximo por Atividade * Carga Horária Máxima)=  25 horas



Soma das Horas Registradas Geral = 33 de registro anteriores com o mesmo id da atividade. importante mesmo que aparesca outra atividade é necessário que mantenha os valores salvos previos das anteriores certificados ou que pelo menos verifique novamente sem já foi registrado quantas horas  foram determinadas.  + Horas registradas 
`Horas Extrapoladas = 63 - 25 - 7
 Extrapoladas = 31




                            mostre o valor de extrapolou na columna chamada horas extrapoladas.  


                            b. Sume o valor das 'horas aceitas do registo anterior'

            - Se não:
                a. Realize a operação do ponto 2, mas não some os valores prévios da coluna "Horas Registradas", pois será o primeiro registro.
                b. Atualize o valor das horas somadas com o valor do primeiro registro.

    - Se não:
        a. Execute a mesma lógica da parte afirmativa na soma e validação, sabendo que sempre irá extrapolar as horas.
        b. Verifique e contabilize corretamente as horas em que o certificado extrapolou o máximo permitido. para realizar as seguintes validações antes de adicionar um novo registro:


0. Crie uma columna chamada de horas Aceitas
1. Verifique se a soma das horas do campo "Horas Registradas" é inferior às horas da "Carga Horária Máxima" do curso.
    - Se sim:
        2. Verifique se o ID da atividade registrada no certificado já foi registrado.
            - Se sim:
                a. Some o valor das "Horas Registradas" do registro anterior.
                b. Verifique se o resultado dessa soma é menor que o valor da multiplicação do "Percentual Máximo por Atividade" pela "Carga Horária Máxima".
                    - Se sim:
                        i. Apresente a mensagem "Ainda pode registrar mais certificados nesta atividade" na coluna de Análises.
                        ii. Calcule o número de horas que ainda podem ser registradas usando a fórmula:
                            `Horas Restantes = (Percentual Máximo por Atividade * Carga Horária Máxima) - Soma das Horas Registradas`
                        iii. Na columna de horas Aceitas  agregue o valor das "Horas Registradas".  
                    - Se não:
                        i. Apresente a mensagem "Ultrapassou as horas permitidas nesta atividade" na coluna de Análises.
                        ii. Calcule quantas horas foram ultrapassadas usando a fórmula:
                            `Horas Extrapoladas = Soma das Horas Registradas - Carga Horária Máxima-Extrapolou`
                        iii. Atualize a variável `Extrapolou` com o valor resultante da fórmula:
                            `Extrapolou = Horas Extrapoladas + Extrapolou`
                       iiii. Na columna de horas Aceitas  agregue o valor das "Horas Registradas" unicamente o valor antes de extrapolar o valor  de 'Horas Extrapoladas'. 

            - Se não:
                a. Realize a operação do ponto 2, mas não some os valores prévios da coluna "Horas Registradas", pois será o primeiro registro.
                b. Atualize o valor das horas somadas com o valor do primeiro registro.

    - Se não:

           3.  Verifique se o ID da atividade registrada no certificado já foi registrado.
            - Se sim:
                a. Some o valor das "Horas Registradas" do registro anterior.
                b. Verifique se o resultado dessa soma é menor que o valor da multiplicação do "Percentual Máximo por Atividade" pela "Carga Horária Máxima".
                    - Se sim:
                        i. Apresente a mensagem "Horas ACC completas mas ainda pode registrar mais certificados nesta atividade" na coluna de Análises.
                        ii. Calcule o número de horas que ainda podem ser registradas  nessa atividade usando a fórmula:
                            `Horas Restantes = (Percentual Máximo por Atividade * Carga Horária Máxima) - Soma das Horas Registradas`
                        iii. Na columna de horas Aceitas  agregue o valor das "Horas Registradas".  
                    - Se não:
                        i. Apresente a mensagem "Horas ACC completas e máximo permitido da atividade cumplido" na coluna de Análises. valor de horas não aceitas. Agregue o valor de 'Horas Extrapoladas'
                        ii. Calcule quantas horas foram ultrapassadas usando a fórmula:
                            `Horas Extrapoladas = Soma das Horas Registradas - Carga Horária Máxima-Extrapolou`
                        iii. Atualize a variável `Extrapolou` com o valor resultante da fórmula:
                            `Extrapolou = Horas Extrapoladas + Extrapolou`
                       iiii. Na columna de horas Aceitas  agregue o valor de 0. 

            - Se não:
                a. Realize a operação do ponto 3. mas não some os valores prévios da coluna "Horas Registradas", pois será o primeiro registro.
                b. Atualize o valor das horas somadas com o valor do primeiro registro. 

No final da tabela agregue uma celda  chamada de total e sume os valores da columanas.  Horas Registradas, Horas Permitidas, Horas Aceitas









        a. Execute a mesma lógica da parte afirmativa na soma e validação, sabendo que sempre irá extrapolar as horas. E na mensagem do campo Análises, mencione Horas 
        b. Verifique e contabilize corretamente as horas em que o certificado extrapolou o máximo permitido.


Essa lógica garante que, para cada atividade, se a soma das horas registradas exceder o máximo permitido, as horas aceitas para registros subsequentes serão ajustadas para refletir apenas o total permitido, podendo chegar a 0 se o registro atual exceder completamente o limite.