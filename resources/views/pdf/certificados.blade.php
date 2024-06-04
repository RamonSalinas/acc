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
        h1 {
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
        <h1>Lista de Certificados</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Certificado</th>
                    <th>Carga Horária</th>
                    <th>Tipo</th>
                    <th>Descrição</th>
                    <th>Local</th>
                    <th>Data Início</th>
                    <th>Data Final</th>
                    <th>Atividade</th>
                    <th>Usuário</th>
                    <th>Horas ACC</th>
                </tr>
            </thead>
            <tbody>
                @foreach($certificados as $certificado)
                    <tr>
                        <td>{{ $certificado->id }}</td>
                        <td>{{ $certificado->nome_certificado }}</td>
                        <td>{{ $certificado->carga_horaria }}</td>
                        <td>{{ $certificado->type }}</td>
                        <td>{{ $certificado->descricao }}</td>
                        <td>{{ $certificado->local }}</td>
                        <td>{{ $certificado->data_inicio }}</td>
                        <td>{{ $certificado->data_final }}</td>
                        <td>{{ $certificado->ngAtividade->nome_atividade ?? 'N/A' }}</td>
                        <td>{{ $certificado->user->name ?? 'N/A' }}</td>
                        <td>{{ $certificado->horas_ACC }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
