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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title></title>
	<meta name="generator" content="LibreOffice 6.4.7.2 (Linux)"/>
	<meta name="author" content="Jacques Antonio de Miranda"/>
	<meta name="created" content="2017-01-25T11:54:07"/>
	<meta name="changed" content="2024-08-15T18:13:21.118533618"/>
	<meta name="AppVersion" content="15.0300"/>
	<meta name="DocSecurity" content="0"/>
	<meta name="HyperlinksChanged" content="false"/>
	<meta name="LinksUpToDate" content="false"/>
	<meta name="ScaleCrop" content="false"/>
	<meta name="ShareDoc" content="false"/>
	
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  } 
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  } 
		comment { display:none;  } 

	</style>
	
</head>

<body>
<table cellspacing="0" border="0">
	<colgroup width="313"></colgroup>
	<colgroup width="123"></colgroup>
	<colgroup width="96"></colgroup>
	<colgroup width="88"></colgroup>
	<colgroup width="83"></colgroup>
	<colgroup width="168"></colgroup>
	<tr>
		<td colspan=6 height="30" align="center" valign=middle bgcolor="#C55A11"><b><font size=4>RELATÓRIO DA AVALIAÇÃO DE DESEMPENHO, CLASSES A, B e C</font></b></td>
		</tr>
	<tr>
		<td colspan=6 height="6" align="center" valign=middle><font size=4><br></font></td>
		</tr>
	<tr>
		<td colspan=6 height="28" align="center" valign=middle bgcolor="#C55A11"><b><font size=4>Formulário específico para USO DO(A) RELATOR(A)</font></b></td>
		</tr>
	<tr>
		<td height="53" align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 height="15" align="left" valign=middle bgcolor="#C55A11"><b><font size=1>IDENTIFICAÇÃO DO DOCENTE</font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle bgcolor="#F8CBAD">Nome</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle><font size=1>{{ $nomeProfessor }}</font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle bgcolor="#F8CBAD">SIAPE</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle sdval="222222222" sdnum="1046;"><font size=1>{{$professor->siape}}</font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle bgcolor="#F8CBAD">Unidade Universitária</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle><font size=1>{{$professor->lotacao}}</font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle bgcolor="#F8CBAD">Regime de Trabalho</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center" valign=middle sdval="20" sdnum="1046;"><font size=1>{{$professor->regime}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=4 align="left" valign=middle bgcolor="#F8CBAD"><font size=1>horas</font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=6 height="23" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle bgcolor="#F8CBAD">Interstício sob avaliação:</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle sdval="41937" sdnum="1046;0;D/M/AAAA"><font size=1>{{$professor->intersticio_data_inicial}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F8CBAD"><font size=1>a</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle sdval="42667" sdnum="1046;0;D/M/AAAA"><font size=1>{{$professor->intersticio_data_final}}</font></td>
		</tr>
		<tbody>
    <tr>
        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="42" align="left" valign=middle bgcolor="#F8CBAD">
            Trata de avaliação de servidora com licença maternidade concedida no período avaliado?
        </td>
        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle>
            @if ($progressao->licence_maternidade == 1)
                SIM
            @else
                NÃO
            @endif
        </td>
        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle sdnum="1046;0;D/M/AAAA">
            @if ($progressao->data_inicial_licenca)
                {{ \Carbon\Carbon::parse($progressao->data_inicial_licenca)->format('d/m/Y') }}
            @else
                NÃO APLICA
            @endif
        </td>
        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F8CBAD">a</td>
        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle sdnum="1046;0;D/M/AAAA">
            @if ($progressao->data_final_licenca)
                {{ \Carbon\Carbon::parse($progressao->data_final_licenca)->format('d/m/Y') }}
            @else
                NÃO APLICA
            @endif
        </td>
     </tr>
</tbody>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 height="23" align="center" valign=middle bgcolor="#F8CBAD"><b>Promoção/progressão pretendida</b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="23" align="left" valign=middle bgcolor="#F8CBAD">Da classe</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><a class="comment-indicator"></a>
		<comment>indicar a classe atual</comment>
		<font size=1>{{$professor->classe}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD">nível</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><a class="comment-indicator"></a>
		<comment>inidicar o nível atual</comment>
		<font size=1>{{$professor->nivel}}</font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="23" align="left" valign=middle bgcolor="#F8CBAD">Para a classe</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><a class="comment-indicator"></a>
		<comment>Infomar a classe pretendida:
A, B ou C</comment>
		<font size=1>{{$progressao->classe}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD">nível</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><a class="comment-indicator"></a>
		<comment>Inserir o nível pretendido:
I, II, III ou IV</comment>
		<font size=1>{{$progressao->nivel}}</font></td>
		<td style="border-left: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="45" align="left" valign=middle bgcolor="#F8CBAD">Pontuação necessária para a progressão ou promoção pretendida, conforme normativa vigente</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle sdval="45" sdnum="1046;"><font size=2>{{$pontos}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle bgcolor="#F8CBAD">pontos</td>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center" valign=middle bgcolor="#F8CBAD" sdval="45" sdnum="1046;"><font size=1 color="#F8CBAD">45</font></td>
	</tr>
	<tr>
		<td height="34" align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
		<td colspan=6 rowspan=2 height="71" align="justify" valign=top>Considerando o relatório apresentado e a análise baseada nos critérios definidos pela Resolução Consuni 01/2017, referente à solicitação de avaliação de desempenho para fins de progressão e promoção funcional, apresenta-se o seguinte relato sobre a pontuação alcançada pelo requerente:</td>
		</tr>
	<tr>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="49" align="center" valign=middle bgcolor="#C55A11"><b>Elementos de avaliação</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#C55A11"><b>Pontuação reconhecida/recomendada</b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="59" align="justify" valign=bottom>I - atividades de ensino na educação superior na UFOB ou em outras IES públicas, neste caso, aprovada pelo Consuni ou por instância competente com delegação e sem percepção de remuneração adicional:</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=bottom><b> {{$aprovadoPorGrupo[1]?? 0 }} <br></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="59" align="justify" valign=middle>II - desempenho didático:</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle><b>{{$aprovadoPorGrupo[2]?? 0 }}<br></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="59" align="justify" valign=middle>III – orientação de estudantes na UFOB ou, no caso de orientação em outras IES públicas, aprovada pelo Consuni ou por instância competente com delegação:</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle><b>{{ $aprovadoPorGrupo[3] ?? 0 }}<br></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="59" align="justify" valign=middle>IV - participação em bancas examinadoras:</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle><b>{{$aprovadoPorGrupo[4]?? 0 }}<br></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="59" align="justify" valign=middle>V - cursos ou estágios de aperfeiçoamento, especialização e atualização, bem como obtenção de créditos e títulos de pós-graduação stricto sensu, exceto quando contabilizados para fins de promoção acelerada:</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle><b>{{$aprovadoPorGrupo[5]?? 0 }}<br></b></td>
		</tr>
	
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="59" align="justify" valign=middle>VIII – atividade de pesquisa, relacionada a projetos de pesquisa, criação e inovação: </td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle><b>{{$aprovadoPorGrupo[8]?? 0}}<br></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="59" align="justify" valign=middle>IX – Exercício de funções de direção, vice-direção, coordenação, vice-coordenação, assessoramento e chefia:</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle><b>{{$aprovadoPorGrupo[9]?? 0}}<br></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="59" align="justify" valign=middle>X - Representação, exceto se contemplado no item anterior, sendo que, no caso de membro suplente, considerar um quarto da pontuação:</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle><b>{{$aprovadoPorGrupo[10]?? 0}}<br></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="33" align="left" valign=middle bgcolor="#F8CBAD"><b>TOTAL</b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#F8CBAD" sdval="0" sdnum="1046;"><b>{{$somaAprovado}}</b></td>
		</tr>
	<tr>
		<td height="33" align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
		<td colspan=6 height="33" align="center" valign=bottom><b><font size=1>{{ $local }}, {{ $dia }} de {{ $mes }} de {{ $ano }}
        .</font></b></td>
		</tr>
	<tr>
		<td height="33" align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
		<td colspan=6 height="24" align="left" valign=bottom><b><font size=1>Relator: {{ $usuario->name }} </font></b></td>
		</tr>
	<tr>
		<td colspan=6 height="33" align="left" valign=bottom><b><font size=1>Dados da Designação: Portaria de nº __________     de  _____  de _______________________ de _________ .</font></b></td>
		</tr>
	<tr>
		<td height="33" align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
    <table width="80%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td height="33" align="center" valign="middle" style="padding: 10px; text-align: center; width: 100%;">
                <b><font size="2">
                    Informações adicionais, se necessário: </font></b> <br> Pontos pendentes de avaliação ou que foram rejeitados no processo de avaliação:
                    <br><br>
                    Grupo 1: {{$pendenteRejeitadaPorGrupo[1] ?? 0}},
                    Grupo 2: {{$pendenteRejeitadaPorGrupo[2] ?? 0}}, Grupo 3: {{$pendenteRejeitadaPorGrupo[3] ?? 0}},
                    Grupo 4: {{$pendenteRejeitadaPorGrupo[4] ?? 0}}, Grupo 5: {{$pendenteRejeitadaPorGrupo[5] ?? 0}},
                    Grupo 6: {{$pendenteRejeitadaPorGrupo[6] ?? 0}}, Grupo 7: {{$pendenteRejeitadaPorGrupo[7] ?? 0}},
                    Grupo 8: {{$pendenteRejeitadaPorGrupo[8] ?? 0}}, Grupo 9: {{$pendenteRejeitadaPorGrupo[9] ?? 0}},
                    Grupo 10: {{$pendenteRejeitadaPorGrupo[10] ?? 0}}.
                    <br><br>
                    Maiores informações podem ser verificadas no Relatório de Avaliação.
               
            </td>
        </tr>
    </table>

		<td align="left" valign=middle><b><font size=1><br></font></b></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
	</tr>
</table>
<!-- ************************************************************************** -->
</body>

</html>
