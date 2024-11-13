<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/res/style.main.css') }}">    <title>Curso ainda não registrado</title>
    <meta name="keywords" content="erro 404" />
	<meta name="description" content="Precisa preencher seu perfil retorne e preenche todos os dados faltantes" />
	
</head>
<body>
    
    <div id="particles" class="particles">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <main>
        <section>
            <h1>Seu curso ainda não registrado!!</h1>
            <div>
                <span>4</span>
                <span class="circle">0</span>
                <span>4</span>
            </div>
            <p>Prezado aluno, você precisa preencher seu perfil.<br> Por favor, clique no botão abaixo e preencha as informações do curso em que está matriculado.</p>
            <div>
            <button onclick="window.location.href='{{ route('filament.admin.pages.settings') }}'">Atualice seu perfil </button>            </div>
        </section>
    </main>

</body>
</html>