@php
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
<A NAME="table0"><h1> <em>Requerimento Progressão</em></h1></A>

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
        <td colspan=3 height="40" align="left" valign=middle>Memorando nº _______/ 20{{ substr($ano, -2) }}.</td>
		<td align="center" valign=middle><br></td>
		<td align="center" valign=middle><br></td>
		<td align="center" valign=middle><br></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
		<td height="42" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="center" valign=middle><br></td>
		<td align="center" valign=middle><br></td>
        <td colspan=2 align="left" valign=middle  style="font-size: 12px; white-space: nowrap;">
        {{ $local }}, {{ $dia }} de {{ $mes }} de {{ $ano }}
    </td>
		</tr>
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
		<td height="34" align="left" valign=middle><b>Ao(À) Professor(a) </b></td>
		<td colspan=8 align="left" valign=middle bgcolor="#FFF2CC"><b>{{ $progressao->nome_direcao}}</b><br></td>
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
    <td height="34" align="left" valign="middle"><b>Diretor(a) do Centro</b></td>
    <td colspan="5" align="left" valign="middle" bgcolor="#FFF2CC"><b>{{ $professor->lotacao }}</b><br></td>
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
		<td colspan=8 rowspan=2 height="45" align="justify" valign=top><b>Assunto: Requerimento de solicitação de instauração de processo de avaliação de desempenho (promoção/progressão).</b></td>
		</tr>
	<tr>
		</tr>
	<tr>
		<td height="23" align="left" valign=middle><b><br></b></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td height="23" align="left" valign=middle><b>Senhor(a) Diretor(a)</b></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td height="23" align="left" valign=middle><b><br></b></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td colspan=8 rowspan=2 height="57" align="justify">        Ao cumprimentá-lo, venho solicitar a vossa senhoria a instauração de processo administrativo referente à avaliação de desempenho para fins de progressão/promoção funcional. Em anexo, apresento relatório devidamente comprovado, informando as atividades desenvolvidas no interstício compreendido no período de </td>
		</tr>
	<tr>
		</tr>
	<tr>
    <td height="23" align="left" bgcolor="#FFF2CC" sdval="41937" sdnum="1046;0;D/M/AAAA">{{$progressao->intersticio_data_inicial}}</td>
		<td align="left" valign=middle>a</td>
        <td align="left" valign=middle bgcolor="#FFF2CC" sdnum="1046;0;D/M/AAAA">{{$progressao->intersticio_data_final}}</td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td colspan=3 height="23" align="center" valign=middle>       Informo tratar-se de solicitação de </td>
		<td align="left" valign=middle>progressão</td>
		<td align="left" valign=middle>da classe/nível</td>
		<td align="center" valign=middle bgcolor="#FFF2CC"> {{$professor->classe. '/' .$professor->nivel}}  </td>
		<td align="left" valign=middle>para a classe/nível</td>
		<td align="left" valign=middle bgcolor="#FFF2CC">{{$progressao->classe. '/' .$progressao->nivel}}</td>
	</tr>
	<tr>
		<td colspan=6 height="23" align="left" valign=middle>       Mantenho-me à disposição para quaisquer esclarecimentos.</td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td colspan=6 height="23" align="left" valign=middle>       Respeitosamente,</td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td height="33" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td height="33" align="left" valign=bottom><b><br></b></td>
		<td colspan=5 align="center" valign=bottom><b>___________________________________________________________</b></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td height="33" align="left" valign=bottom><b><br></b></td>
		<td colspan=5 align="center" valign=bottom bgcolor="#FFF2CC"><b>{{$nomeProfessor}}</b></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
</table>