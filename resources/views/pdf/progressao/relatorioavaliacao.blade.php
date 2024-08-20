<style>
    table {
        width: 90%;
        table-layout:auto;
    }
 
</style>

<table cellspacing="0" border="0">
	<colgroup width="283"></colgroup>
	<colgroup width="144"></colgroup>
	<colgroup width="96"></colgroup>
	<colgroup width="121"></colgroup>
	<colgroup width="83"></colgroup>
	<colgroup width="221"></colgroup>
	<colgroup width="109"></colgroup>
	<colgroup width="255"></colgroup>
	<tr>
		<td colspan=8 height="30" align="center" valign=middle bgcolor="#C55A11"><b><font size=4>FORMULÁRIO PARA SOLICITAÇÃO DE PROMOÇÃO/PROGRESSÃO FUNCIONAL</font></b></td>
		</tr>
	<tr>
		<td colspan=8 height="6" align="center" valign=middle><font size=4><br></font></td>
		</tr>
	<tr>
		<td colspan=8 height="28" align="center" valign=middle bgcolor="#C55A11"><b><font size=4>Formulário específico para as classes A, B e C</font></b></td>
		</tr>
	<tr>
		<td height="53" align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
		<td align="center" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 height="15" align="left" valign=middle bgcolor="#C55A11"><b><font size=1>IDENTIFICAÇÃO DO DOCENTE</font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle bgcolor="#F8CBAD">Nome</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle><font size=5>{{ $nomeProfessor }}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 rowspan=3 align="center" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle bgcolor="#F8CBAD">SIAPE</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle sdval="222222222" sdnum="1046;"><font size=1>{{$professor->siape}} </font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle bgcolor="#F8CBAD">Unidade Universitária</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=5 align="center" valign=middle><font size=1>{{$professor->lotacao}}</font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle bgcolor="#F8CBAD">Regime de Trabalho</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center" valign=middle sdval="40" sdnum="1046;"><font size=1>{{$professor->regime}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" colspan=4 align="left" valign=middle bgcolor="#F8CBAD"><font size=1>horas</font></td>
		<td style="border-bottom: 1px solid #000000" align="center" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 height="23" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="23" align="left" valign=middle bgcolor="#F8CBAD">Interstício sob avaliação:</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle sdval="41937" sdnum="1046;0;D/M/AAAA"><font size=1>{{$professor->intersticio_data_inicial}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font size=1>a</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle sdval="42667" sdnum="1046;0;D/M/AAAA"><font size=1>{{$professor->intersticio_data_final}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
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
        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
    </tr>
</tbody>
<tr>
    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=8 height="23" align="center" valign=middle bgcolor="#F8CBAD"><b>Promoção/progressão pretendida</b></td>
</tr>

	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="23" align="left" valign=middle bgcolor="#F8CBAD">Da classe</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><a class="comment-indicator"></a>
		<font size=1>{{$professor->classe}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD">nível</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><a class="comment-indicator"></a>
		<font size=1>{{$professor->nivel}}</font></td>
		<td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
		<td style="border-top: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
		<td style="border-top: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="23" align="left" valign=middle bgcolor="#F8CBAD">Para a classe</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><a class="comment-indicator"></a>
		
		<font size=1>{{$progressao->classe}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD">nível</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><a class="comment-indicator"></a>
		
		<font size=1>{{$progressao->nivel}}</font></td>
		<td style="border-left: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
		<td align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
		<td style="border-right: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="45" align="left" valign=middle bgcolor="#F8CBAD">Pontuação necessária para a progressão ou promoção pretendida, conforme normativa vigente</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="right" valign=middle sdval="45" sdnum="1046;"><font size=2>{{$pontos}}</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle bgcolor="#F8CBAD">pontos</td>
		<td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center" valign=middle bgcolor="#F8CBAD" sdval="45" sdnum="1046;"><font size=1 color="#F8CBAD">{$progressao->nivel}}</font></td>
		<td style="border-bottom: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=middle bgcolor="#F8CBAD"><font size=1><br></font></td>
	</tr>
	<tr>
		<td height="34" align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
	<h2> Pontuação Deferida Avaliador: <strong>{{ $totalPontuacaoAvaliadorController}}.</h2></strong></p>

	

<!-- Inicio Tabela Análises Progressão-->
<<!-- Inicio Tabela Análises Progressão-->
@php
    $totalQuantidade = 0;
    $totalPontuacao = 0;
    $totalPontuacaoAvaliador = 0; // Adiciona variável para totalizar pontos avaliador
    $grupoPontuacoes = [];
@endphp

@foreach($grupos as $grupo)
<h2>Grupo de Progressão: {{ $grupo->nome_grupo_progressao }}</h2>
<p>Data Inicial do Interstício: {{ $progressao->intersticio_data_inicial }}</p>
<table style="width: 100%; border-collapse: separate; border-spacing: 0; border: 1px solid black;">
    <thead style="background-color: #d3d3d3;">
        <tr>
            <th style="border: 1px solid black;">ID Atividade Progressão</th> <!-- Nova coluna -->
            <th style="border: 1px solid black;">Referência</th>
            <th style="border: 1px solid black;">Quantidade</th>
            <th style="border: 1px solid black;">Pontuação</th>
            <th style="border: 1px solid black;">Pontos    Avaliador</th> <!-- Nova coluna -->
            <th style="border: 1px solid black;">Data    Inicial</th>
            <th style="border: 1px solid black;">Data    Final</th>
            <th style="border: 1px solid black;">Observação</th> <!-- Nova coluna -->
            <th style="border: 1px solid black;">Observação Avaliador</th> <!-- Nova coluna -->
            <th style="border: 1px solid black;">Status</th>
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
                <td style="border: 1px solid black;">{{ $certificado->ng_atividades_progressao_id }}</td> <!-- Nova coluna -->
                <td style="border: 1px solid black;">{{ $certificado->referencia }}</td>
                <td style="border: 1px solid black;">{{ $certificado->quantidade }}</td>
                <td style="border: 1px solid black;">{{ $certificado->pontuacao }}</td>
                <td style="border: 1px solid black;">{{ $certificado->pontuacao_avaliador }}</td> <!-- Nova coluna -->
                <td style="border: 1px solid black;" class="{{ $isEarlier ? 'text-red' : 'text-black' }}">{{ $certificado->data_inicial }}</td>
                <td style="border: 1px solid black;">{{ $certificado->data_final }}</td>
                <td style="border: 1px solid black;">{{ $certificado->observacao }}</td> <!-- Nova coluna -->
                <td style="border: 1px solid black;">{{ $certificado->observacao_avaliador }}</td> <!-- Nova coluna -->
                <td style="border: 1px solid black;">{{ $certificado->status }}</td>
            </tr>
            @php
                $grupoQuantidade += $certificado->quantidade;
                $grupoPontuacao += $certificado->pontuacao;
                //$grupoPontuacaoAvaliador += $certificado->pontuacao_avaliador; // Soma pontos avaliador do grupo
				if ($certificado->status == 'Aprovado') {
                    $grupoPontuacaoAvaliador += $certificado->pontuacao_avaliador; // Soma pontos avaliador do grupo apenas se aprovado
                }
            @endphp
        @endforeach
        <tr style="background-color: #d3d3d3;">
            <th style="border: 1px solid black;">Total do Grupo</th>
            <td style="border: 1px solid black;" colspan="2">{{ $grupoQuantidade }}</td>
            <td style="border: 1px solid black;">{{ $grupoPontuacao }}</td>
            <td style="border: 1px solid black;">{{ $grupoPontuacaoAvaliador }}</td> <!-- Total pontos avaliador do grupo -->
            <td style="border: 1px solid black;" colspan="5"></td>
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






