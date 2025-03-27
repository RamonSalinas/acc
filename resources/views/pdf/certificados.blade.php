<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificados PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        h1, h2, h3 {
            text-align: center;
        }
        .header-info {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f4f4f4;
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
        .page-break {
            page-break-after: always;
        }
        .image-container {
            text-align: center;
            margin-top: 20px;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<p style="text-align: center; font-size: 16px; font-weight: bold; margin-bottom: 20px;">
    <a href="http://127.0.0.1:8000/storage/unificado.pdf" target="_blank" style="color: blue; text-decoration: underline;">
        BAIXAR PDF DOCUMENTOS SALVOS
    </a>
</p>
        <table>
            <thead>
                <tr>
                    <th>Nome Certificado</th>
                    <th>Carga Horária</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Local</th>
                    <th>Data Início</th>
                    <th>Data Final</th>
                    <th>Atividade</th>
                    <th>Horas ACC</th>
                </tr>
            </thead>
            <tbody>
                @foreach($certificados as $certificado)
                    <tr>
                        <td>{{ $certificado->nome_certificado }}</td>
                        <td>{{ $certificado->carga_horaria }}</td>
                        <td>{{ $certificado->type }}</td>
                        <td>{{ $certificado->descricao }}</td>
                        <td>{{ $certificado->local }}</td>
                        <td>{{ $certificado->data_inicio }}</td>
                        <td>{{ $certificado->data_final }}</td>
                        <td>{{ $certificado->ngAtividade->nome_atividade ?? 'N/A' }}</td>
                        <td>{{ $certificado->horas_ACC }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

      
@foreach($certificados as $certificado)
    <div class="certificate-container" style="page-break-inside: avoid; margin-bottom: 20px;">
        <div class="image-container" style="text-align: center; margin-bottom: 10px;">
            @if($certificado->arquivo)
                @php
                    $filePath = public_path('storage/' . $certificado->arquivo);
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                @endphp

                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                    @if(file_exists($filePath))
                        <img src="{{ asset('storage/' . $certificado->arquivo) }}" alt="Certificado" style="max-width: 60%; height: auto;">
                    @else
                        <p style="font-size: 12px; color: red;">Imagem não encontrada ou indisponível.</p>
                    @endif
                @elseif($fileExtension === 'pdf')
                    <div style="text-align: center; margin-bottom: 10px;">
                        <embed src="{{ asset('storage/' . $certificado->arquivo) }}" type="application/pdf" width="80%" height="500px" />
                        <p style="font-size: 12px; margin-top: 10px;">Se o PDF não carregar, clique no link abaixo para visualizá-lo ou baixá-lo:</p>
                        <a href="{{ asset('storage/' . $certificado->arquivo) }}" target="_blank" style="font-size: 14px; color: blue; text-decoration: underline;">
                            Visualizar ou Baixar PDF
                        </a>
                    </div>
                @else
                    <p style="font-size: 12px;">Formato de arquivo não suportado: {{ $fileExtension }}</p>
                @endif
            @else
                <p style="font-size: 12px;">Arquivo não disponível</p>
            @endif
        </div>

        <div class="info-container" style="font-size: 12px;">
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <tr>
                    <td style="border: 1px solid #ddd; padding: 6px;">Carga Horária</td>
                    <td style="border: 1px solid #ddd; padding: 6px;">{{ $certificado->carga_horaria }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 6px;">Grupo Atividade</td>
                    <td style="border: 1px solid #ddd; padding: 6px;">{{ $certificado->grupo_atividades }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 6px;">Atividade</td>
                    <td style="border: 1px solid #ddd; padding: 6px;">{{ $certificado->ngAtividade->nome_atividade ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 6px;">Horas ACC</td>
                    <td style="border: 1px solid #ddd; padding: 6px;">{{ $certificado->horas_ACC }}</td>
                </tr>
            </table>
        </div>
    </div>
@endforeach
    </div>
</body>
</html>