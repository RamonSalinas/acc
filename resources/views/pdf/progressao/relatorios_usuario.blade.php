s<!DOCTYPE html>
<html>
<head>
    <title>Relatórios do Usuário</title>
</head>
<body>
    <h1>Relatórios do Usuário</h1>
    <ul>
        @foreach($progressaos as $progressao)
            <li>{{ $progressao->nome_progressao }}</li>
        @endforeach
    </ul>
</body>
</html>