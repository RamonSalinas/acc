@php

$somaAprovado = ($aprovadoPorGrupo[1] ?? 0) +
                    ($aprovadoPorGrupo[2] ?? 0) +
                    ($aprovadoPorGrupo[3] ?? 0) +
                    ($aprovadoPorGrupo[4] ?? 0) +
                    ($aprovadoPorGrupo[5] ?? 0) +
                    ($aprovadoPorGrupo[6] ?? 0) +
                    ($aprovadoPorGrupo[7] ?? 0) +
                    ($aprovadoPorGrupo[8] ?? 0) +
                    ($aprovadoPorGrupo[9] ?? 0) +
                    ($aprovadoPorGrupo[10] ?? 0);


    setlocale(LC_TIME, 'pt_BR.UTF-8'); // Define o locale para português do Brasil
    $dia = $dataAtual->format('d');
   // $mes = $dataAtual->formatLocalized('%B'); // Nome do mês em português
    $mes = strftime('%B', $dataAtual->getTimestamp()); // Nome do mês em português

    $ano = $dataAtual->format('Y');
    // Definir o local com base na lotação do professor
    switch ($professor->lotacao) {
        case 'CCET':
        case 'CCBS':
        case 'CEHU':
            $local = 'Barreiras (BA)';
            break;
        case 'CMSMV':
            $local = 'Santa Maria da Vitória (BA)';
            break;
        case 'CMB':
            $local = 'Barra (BA)';
            break;
        case 'CMLEM':
            $local = 'Luis Eduardo Magalhães (BA)';
            break;
        case 'CMBJL':
            $local = 'Bom Jesus da Lapa (BA)';
            break;
        default:
            $local = 'Local desconhecido';
            break;
    }
@endphp






<hr>
<A NAME="table0"><h3> <em>Processo de nº 23520.</em></h3></A>

<table cellspacing="0" border="0">
	<colgroup width="161"></colgroup>
	<colgroup width="23"></colgroup>
	<colgroup width="99"></colgroup>
	<colgroup width="89"></colgroup>
	<colgroup width="119"></colgroup>
	<colgroup width="63"></colgroup>
	<colgroup width="160"></colgroup>
	<colgroup width="67"></colgroup>

	<tr>
		<td height="53" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="center" valign=middle><br></td>
		<td align="center" valign=middle><br></td>
		<td align="center" valign=middle><br></td>
		<td align="center" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	
    <tr>
        <td height="20" align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><b><font color="#000000"></font></b></td>
		<td height="34" align="left" valign=middle><b>Origem: </b></td>
		<td colspan=5 align="left" valign=middle bgcolor="#FFF2CC">{{ $professor->lotacao }}<br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>

    <tr>
		<td height="6" align="left" valign=middle><b><br></b></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>

	<tr>
       <td height="20" align="left" valign=bottom><font color="#000000"><br></font></td>
       <td align="left" valign=bottom><b><font color="#000000"></font></b></td>
		<td height="34" align="left" valign=middle><b>Interessado </b></td>
		<td colspan=5 align="left" valign=middle bgcolor="#FFF2CC">{{ $nomeProfessor }}<br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td height="6" align="left" valign=middle><b><br></b></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>


        <td height="20" align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><b><font color="#000000"></font></b></td>
		<td height="34" align="left" valign=middle><b>Assunto:</b></td>
		<td colspan=5 align="left" valign=middle bgcolor="#FFF2CC">Avaliação de desempenho (promoção/progressão).<br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td height="6" align="left" valign=middle><b><br></b></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
    <tr>
    <td height="34" align="left" valign="middle"><b>Relator:</b></td>
    <td colspan="5" align="left" valign="middle" bgcolor="#FFF2CC"><b>{{ $usuario->name}}</b><br></td>
    <td align="left" valign=middle><br></td>
    <td align="left" valign=middle><br></td>
    </tr>
	</tr>


    <tr>
    <tr>
    <td height="34" align="left" valign="middle"><b>Portaria de Designação nº:</b></td>
    <td colspan="5" align="left" valign="middle" bgcolor="#FFF2CC"><b>xxxxxxxxxxxxxxxxx</b><br></td>
    <td align="left" valign=middle><br></td>
    <td align="left" valign=middle><br></td>
    </tr>
	</tr>

	<tr>
		<td height="34" align="left" valign=middle><b><br></b></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td colspan=8 rowspan=2 height="45" align="justify" valign=top>À Presidência do Conselho Diretor e em atendimento à designação, apresento(amos) parecer conclusivo.</td>
		</tr>
	<tr>
		</tr>
	
    <tr>
        <td colspan=8 rowspan=2 height="45" align="justify" valign=top>Trata-se de processo criado pelo Centro.  <b>{{ $professor->lotacao }}</b><br>     
        O processo tem por objeto a análise da solicitação de avaliação de desempenho docente para fins de progressão na carreira do Magistério Superior no âmbito da Universidade Federal do Oeste da Bahia. 
        O relatório apresentado contém XXX folhas, estando devidamente comprovado pelo(a) requerente. Foram avaliadas as atividades desenvolvidas no interstício compreendido no período 
        de <b>{{$progressao->intersticio_data_inicial}} </b> a <b>{{$progressao->intersticio_data_final}}</b>, considerando-se as exigênicas para acesso à classe\nível {{$progressao->classe. '/' .$progressao->nivel}}.  <br><br>
        Diante das informações prestadas e considerando a análise realizada com base na Resolução nº 01/2017 do Conselho Universitário da Universidade Federal do Oeste da Bahia, registra-se que o(a) docente alcançou <b> {{$somaAprovado}}</b>.  <br><br>
        Neste sentido, considero(amos) o(a) professor(a) <b>{{$nomeProfessor}}</b> apto(a) a progredir da clase <b>{{$professor->classe. '/' .$professor->nivel}}</b> para a classe/nível <b>{{$progressao->classe. '/' .$progressao->nivel}}</b> , 
        referento ao interstício de <b>{{$progressao->intersticio_data_inicial}} </b> a <b>{{$progressao->intersticio_data_final}}</b>,.<br> 
    <br>
   
    Salvo melhor Juízo, este é o parecer.  
    <br>
    <br>
  

    {{ $local }}, {{ $dia }} de {{ $mes }} de {{ $ano }}
    </td>
		</tr>


        </tr>
	<tr>
		</tr>
        <tr>
    <td colspan=6 height="23" align="left" valign="middle">Respeitosamente,</td>
    <td align="left" valign="middle"><br><br><br></td>
    <td align="left" valign="middle"><br><br><br></td>
    <td align="left" valign="middle"><br><br><br></td>
    <td align="left" valign="middle"><br><br><br></td>
    <td align="left" valign="middle"><br><br><br></td>
    <td align="left" valign="middle"><br><br><br></td>
</tr>

<tr>
    <td height="33" align="left" valign="bottom"><b><br><br><br></b></td>
    <td colspan=5 align="center" valign="bottom" bgcolor="#FFF2CC"><b>{{$usuario->name}}</b><br>Relator/Avaliadores</td>
    <td align="left" valign="middle"><br><br><br></td>
    <td align="left" valign="middle"><br><br><br></td>
</tr>
</table>