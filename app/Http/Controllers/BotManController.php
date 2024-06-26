<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AdCursos;
use Illuminate\Support\Facades\Log;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Session;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Attachments\Audio;
use BotMan\BotMan\Messages\Attachments\File;

class BotManController extends Controller
{
    public function handle()
    {
        $config = [];

        // Carregar o driver web do BotMan
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

        // Criar uma instância do BotMan
        $botman = BotManFactory::create($config);

        // Definir comandos
        $this->defineCommands($botman);

        // Start listening
        $botman->listen();
    }

    private function defineCommands(BotMan $botman)
{

    
    $botman->hears('meu_curso', function (BotMan $bot) {
        $this->handleMeuCurso($bot);
    });

    $botman->hears('registrar_acc', function (BotMan $bot) {
        $this->RegistarACC($bot);
    });

    $botman->hears('info_acc', function (BotMan $bot) {
        $this->handleInfoACC($bot);
    });

    $botman->hears('pedir_aproveitamento', function (BotMan $bot) {
        $this->PedirAproveitamento($bot);
    });
    
    $botman->hears('sobre_aproveitamento', function (BotMan $bot) {
        $this->InfoAproveitamento($bot);
    });
  //  $botman->hears('aproveitamento_estudos', function (BotMan $bot) {
    //    $this->handleAproveitamento($bot);
  //  });

  $botman->hears('abrir_processo', function (BotMan $bot) {
    // Chame o método que lida com a abertura do processo acadêmico
    $this->AbrirProcessoAcademico($bot);
});
    //$botman->hears('matriculas', function (BotMan $bot) {
     //   $this->handleMatricula($bot);
   // });
   $botman->hears('como_matricular', function (BotMan $bot) {
    // Chame o método que lida com a abertura do processo acadêmico
    $this->ComoMatricular($bot);
});

$botman->hears('duvidas_matricula', function (BotMan $bot) {
    // Chame o método que lida com a abertura do processo acadêmico
    $this->ManualMatricular($bot);
});
    // Manipulador geral para texto livre
    // Este deve ser o último 'hears' antes do fallback para evitar conflitos
    $botman->hears('.*', function (BotMan $bot) {
        $message = $bot->getMessage();
        $this->processUserMessage($bot, $message->getText());
    });

    // Fallback para mensagens não reconhecidas
    $botman->fallback(function (BotMan $bot) {
        $this->handleFallback($bot);
    });
}

    private function processUserMessage(BotMan $bot, $message)
    {
        $intent = $this->detectIntent($message);

        switch ($intent) {
            case 'saudacao':
                $this->greetUser($bot);
                break;
            case 'meu_curso':
                $this->handleMeuCurso($bot);
                break;
            case 'info_acc':
                $this->handleInfoACC($bot);
                break;
            case 'main_menu':
                $this->showMainMenu($bot);
                break;
            case 'acc':
                $this->handleACC($bot);
                break;
            case 'aproveitamento':
                $this->handleAproveitamento($bot);
                break;

            case 'abrir_processo':
                $this->AbrirProcessoAcademico($bot);
                    break;    
            case 'matricula':
                $this->handleMatricula($bot);
                break;

                case 'como_matricular':
                    $this->ComoMatricular($bot);
                    break;

                
            case 'despedida':
                $this->sayGoodbye($bot);
                break;
            default:
                $this->handleFallback($bot);
                break;
        }
    }

    private function detectIntent($message)
    {
        $intent = 'desconhecido';

        // Condições para detectar diferentes intenções
        if (preg_match('/^(Oi|Olá|Ola|Bom dia|Boa tarde|Boa noite)$/i', $message)) {
            $intent = 'saudacao';
        } elseif (preg_match('/meu curso/i', $message)) {
            $intent = 'meu_curso';
        } elseif (preg_match('/info acc|atividades complementares curriculares|barema/i', $message)) {
            $intent = 'info_acc';
        } elseif (preg_match('/info menu|ajuda|inicioss|menu/i', $message)) {
            $intent = 'main_menu';
        } elseif (preg_match('/acc|atividades complementares curriculares|registrar acc/i', $message)) {
            $intent = 'acc';
        } elseif (preg_match('/aproveitamento|aproveitamento de estudos/i', $message)) {
            $intent = 'aproveitamento';
        } elseif (preg_match('/abrir|abrir processo|abrir processo curso/i', $message)) {
            $intent = 'abrir_processo';
       } elseif (preg_match('/matricula|matricular/i', $message)) {
           $intent = 'matricula';
        } elseif (preg_match('/adeus/i', $message)) {
            $intent = 'despedida';
        }

        return $intent;
    }

    private function handleFallback(BotMan $bot)
    {
        $bot->typesAndWaits(2);
        $bot->reply('Desculpe, não entendi. Poderia escolher uma das opções disponíveis no menu?');
        $this->showMainMenu($bot);
    }


    

    private function greetUser(BotMan $bot)
    {
        $user = Auth::user();
        $nomeUsuario = $user ? $user->name : 'como posso ajudar😊?';
    
        $menu = Question::create("Oi $nomeUsuario, como posso ajudar😊?")
            ->fallback('Não foi possível fazer a pergunta')
            ->callbackId('main_menu1')
            ->addButtons([
               // Button::create('📚 Qual é o meu curso?')->value('meu_curso'),
                Button::create('ℹ Informações sobre o ACC')->value('registrar_acc'),
                Button::create('🔄 Aproveitamento de Estudos')->value('aproveitamento_estudos'),
                Button::create('📝 Matrículas')->value('como_matricular'),
                Button::create('Abrir processo acadêmico')->value('abrir_processo'),

            ]);
    
        $bot->reply($menu);
    
        $attachment = new Image(asset('assets/robot.gif'));        
        $message = OutgoingMessage::create('')
                ->withAttachment($attachment);
    
        // Corrigido para enviar a mensagem com anexo
        $bot->reply($message);
    }

    private function handleMeuCurso(BotMan $bot)
    {
        $user = Auth::user();
        if ($user && $user->id_curso) {
            $curso = AdCursos::find($user->id_curso);
            $resposta = $curso ? 'Você está matriculado no curso de ' . $curso->nome_curso . '.' : 'Não consegui encontrar informações sobre o seu curso.';
        } else {
            $resposta = 'Não consegui encontrar informações sobre o seu curso.';
        }
        $bot->reply($resposta);

        // Correção na criação do anexo de vídeo
        $videoUrl = asset('assets/video.mp4'); // Ajuste para a URL correta do vídeo
        $attachment = new Video($videoUrl, [
            'custom_payload' => true,
        ]);
        $message = OutgoingMessage::create('Time - UFOB')
                ->withAttachment($attachment);
    
        // Enviar a mensagem com anexo
        $bot->reply($message);
        
        // Continuar com a função showMainContinuar
        $this->showMainContinuar($bot);
    }

    private function handleInfoACC(BotMan $bot)
    {   $sigga= 'https://sig.ufob.edu.br/sigaa/public/home.jsf';
        $Baremaurl = asset('assets/Barema.pdf'); // Certifique-se de que esta URL é acessível e correta

        $user = Auth::user();
        $curso = AdCursos::find($user->id_curso);

        $randomNumber = rand(1, 2);
        $accInfo = "As atividades complementares (ACCs) são importantes para a formação acadêmica, abrangendo estudos acadêmicos, ciência, cultura, arte, esporte, extensão e experiências sociais e profissionais. Você faz parte do PPC $curso->ppc, por tanto é necessário que registre $curso->carga_horaria_ACC horas de ACC e  $curso->carga_horaria_Extensao horas de Extensão. A cada semestre, o curso envia um comunicado para alunos próximos à formatura, pedindo para verificarem suas horas ACC. Os alunos devem preencher um formulário no <a href=\"$sigga\" target=\"_blank\">SIGGA</a> e anexar os certificados. O Barema Oficial do CCET, disponível no SIGAA, ajuda a calcular as equivalências das horas ACC. Para mais informações, peça o <a href=\"$Baremaurl\" target=\"_blank\">Barema Oficial do CCET</a> Valeu!";
        $accInfo1 = "E aí!. $user->name . ', Então, as atividades complementares são aquelas que dão um up na nossa formação, abrangendo coisas como estudos acadêmicos, ciência, cultura, arte, esporte, extensão e até experiências sociais e profissionais. Você faz parte do PPC $curso->ppc, você precisa de que registre $curso->carga_horaria_ACC horas de ACC e  $curso->carga_horaria_Extensao horas de Extensão. A cada semestre, o pessoal do curso lança um comunicado para a galera que tá quase se formando, tipo você, pedindo pra dar uma olhada nas horas ACC. Aí é só preencher um formulário no SIGAA e colar os certificados. Entra lá no SIGAA e olha os avisos dos semestres passados, porque é lá que tá o tal do <a href=\"$Baremaurl\" target=\"_blank\">Barema Oficial do CCET</a> que ajuda a fazer as contas das equivalências das horas ACC. Valeu!";        
          // Escolhe entre $accInfo e $accInfo1 com base no número gerado
          $selectedInfo = ($randomNumber == 1) ? $accInfo : $accInfo1;
          $bot->reply($selectedInfo);
        
        //$bot->reply($accInfo);

        $audioUrl = asset('assets/audio.mp3'); // Ajuste para a URL correta do áudio
        $attachment = new Audio($audioUrl, [
            'custom_payload' => true,
        ]);

       $message = OutgoingMessage::create('🎵 Ouça mais sobre ACC')
              ->withAttachment($attachment);

        // Enviar a mensagem com anexo de áudio
        $bot->reply($message);
        
        // Continuar com a função showMainContinuar
        //$this->showMainContinuar($bot);
    }

    private function showMainMenu(BotMan $bot)
    {
        $menu = Question::create("Como posso ajudar?")
            ->fallback('Não foi possível fazer a pergunta')
            ->callbackId('main_menu')
            ->addButtons([
               // Button::create('📚 Qual é o meu curso?')->value('meu_curso'),
                Button::create('ℹ Informações sobre o ACC')->value('info_acc'),
                Button::create('🔄 Aproveitamento de Estudos')->value('aproveitamento_estudos'),
                Button::create('📝 Matriculas')->value('como_matricula'),
                Button::create('Abrir processo acadêmico')->value('abrir_processo'),
            ]);

        $bot->reply($menu);
    }

    private function handleACC(BotMan $bot)
    {
        Log::info('ACC keyword detected');
        $question = Question::create('As atividades complementares (ACC) são aquelas que dão um up na nossa formação, você pode seguir estas orientaçõesa')
            ->fallback('Não foi possível fazer a pergunta')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('📋 Como registrar ACC')->value('registrar_acc'),
                Button::create('❓ O que são ACC')->value('info_acc'),
                Button::create('Voltar')->value('main_menu'),
            ]);

        $bot->reply($question);
        //Continuar com a função showMainContinuar
     //   $this->showMainContinuar($bot);
    }

    private function RegistarACC(BotMan $bot)
    {
        $Baremaurl = asset('assets/Barema.pdf'); // Certifique-se de que esta URL é acessível e correta
        $sigga= 'https://sig.ufob.edu.br/sigaa/public/home.jsf';
        Log::info('Registar keyword detected');
        $user = Auth::user();
        $randomNumber = rand(1, 2);
        $Registrar_acc = "Respondendo a sua pergunta '. $user->name. 'As atividades complementares (ACCs) podem ser registradas no <a href=\"$sigga\" target=\"_blank\">SIGGA</a> no menú Atividades Autônomas mas deve seguir o Barema oficial do Centro onde apresentam as equivalências das atividades, veja ele <a href=\"$Baremaurl\" target=\"_blank\">AQUI</a>";  
        $Registrar_acc1 = "E aí! '. $user->name . ', Então, as atividades complementares São registridas na opção Atividades Autônomas de seu menu do <a href=\"$sigga\" target=\"_blank\">SIGGA</a>, entanto só serão avaliadas pela coordenação quando você integralice todas suas disciplinas . Valeu!";        
          // Escolhe entre $accInfo e $accInfo1 com base no número gerado
          $selectedInfo = ($randomNumber == 1) ? $Registrar_acc : $Registrar_acc1;
          $bot->reply($selectedInfo);
          
    }

    private function handleAproveitamento(BotMan $bot)
    {
        Log::info('Aproveitamento de Estudos keyword detected');
        $question = Question::create('O aproveitamento de estudos consiste na dispensa do cumprimento de atividades escolares do currículo do curso, você pode seguir estas orientaçõesa ' )
            ->fallback('Não foi possível fazer a pergunta')
            ->callbackId('ask_reason_aproveitamento')
            ->addButtons([
                Button::create('📋 Como pedir aproveitamento')->value('pedir_aproveitamento'),
                Button::create('❓ O que é aproveitamento de estudos')->value('sobre_aproveitamento'),
            ]);

        $bot->reply($question);
    }

    private function PedirAproveitamento(BotMan $bot)
    { 
        Log::info('Registar keyword detected');
        $user = Auth::user();
        $curso = AdCursos::find($user->id_curso);
        $url = "https://ufob.edu.br/ensino/agenda-academica"; // Substitua pela URL desejada


        $randomNumber = rand(1, 2);
        $Registrar = "Respondendo a sua pergunta '. $user->name. 'Para solicitar o aproveitamento de disciplinas precisa de realizar abertura de um processo acadêmico é necessário que toda a documentação comprobatória necessária para a abertura do processo (requerimentos, históricos escolares, ementas, certificados e declarações, dentre outros) seja entregue no formato PDF, enviados por meio de formulário para a Secretaria dos Colegiados dos Curso .$curso->nome_curso. escreva 'abrir processo' mais informações";  
        $Registrar1 = "E aí! '. $user->name . ', Então, as atividades complementares São registridas na opção Atividades Autônomas de seu menu do Sigga, entanto só serão avaliadas pela coordenação quando você integralice todas suas disciplinas . Valeu!";        
        $Registrar2 = "Para solicitar o aproveitamento de estudos tem que abrir um processo e encaminhar para a secretaria do colegiados <a href=\"$url\">colegiados.ccet@ufob.edu.br </a> para seu inicio, escreva 'abrir processo' para te ajudar a abrir o processo acadêmico.";
                // Escolhe entre $accInfo e $accInfo1 com base no número gerado
          $selectedInfo = ($randomNumber == 1) ? $Registrar : $Registrar2; 
          $bot->reply($selectedInfo);
    }

    private function InfoAproveitamento(BotMan $bot)
    {
        $user = Auth::user();
        $randomNumber = rand(1, 2);
        $Info = " Dispensa de disciplinas que pode ser concedida ao estudante já cursou previamente o conteúdo, parcial ou total, da disciplina em outra instituição de ensino superior.";
        $Info1 = "E aí!. $user->name . ', Cada Processo Acadêmico apresenta uma demanda específica, sendo assim seguir o Manual de Procedimentos – Abertura de Processos acadêmicos (link: https://sa.ufob.edu.br/index.php/component/phocadownload/category/9-sae?download=770:manual-de-procedimentos-abertura-de-processos-academicos).  Valeu!";        
          // Escolhe entre $accInfo e $accInfo1 com base no número gerado
          $selectedInfo = ($randomNumber == 1) ? $Info : $Info1;
          $bot->reply($selectedInfo);
        $audioUrl = asset('assets/audio.mp3'); // Ajuste para a URL correta do áudio
        $attachment = new Audio($audioUrl, [
            'custom_payload' => true,
        ]);
       $message = OutgoingMessage::create('🎵 Ouça mais sobre Aproveitamento de Estudos')
              ->withAttachment($attachment);
        // Enviar a mensagem com anexo de áudio
        $bot->reply($message);
         }

         private function AbrirProcessoAcademico(BotMan $bot)
         {
            $bot->reply("Você escolheu abrir um processo acadêmico. Aqui estão os passos...");
            $TextUrl = asset('assets/abertura.docx'); // Certifique-se de que esta URL é acessível e correta
            $ICPEduUrl = 'https://pessoal.icpedu.rnp.br/home'; // Certifique-se de que esta URL é acessível e correta
            $AssinarUrl= 'https://assinador.iti.br'; // Certifique-se de que esta URL é acessível e correta
            $SecretariaUrl = 'https://ufob.edu.br/a-ufob/unidades-academicas/ccet/fale-conosco'; // Certifique-se de que esta URL é acessível e correta
            $ProtiposUrl = 'https://protic.ufob.edu.br/'; // Certifique-se de que esta URL é acessível e correta            
            // Ajuste a criação da mensagem para incluir o link de forma correta
            $messageText = "1️⃣ <strong>Preencha o formulário:</strong><br> Baixe e preencha o formulário necessário <a href=\"$TextUrl\">AQUI </a>";
            $message = OutgoingMessage::create($messageText);
            $sigga= 'https://sig.ufob.edu.br/sigaa/public/home.jsf';
            $sipac= 'https://sig.ufob.edu.br/sipac/?modo=classico';

            // Se você deseja enviar o arquivo como anexo
            $attachment = new File($TextUrl, ['custom_payload' => true,]);
            $message->withAttachment($attachment);
            
            // Passo 1
            $bot->reply($message);
         
             // Passo 2
             $bot->reply("2️⃣ <strong>Assine o formulário:</strong><br> Assine usando o certificado <a href=\"$ICPEduUrl\" target=\"_blank\">ICPEdu</a>. Siga o manual de instalação da <a href=\"$ProtiposUrl\" target=\"_blank\">PROTIC</a>");
         
             // Passo 3
             $bot->reply("3️⃣ <strong>Problemas com ICPEdu?</strong><br>  Use o site GOV.BR para <a href=\"$AssinarUrl\" target=\"_blank\">ASSINAR</a>");
         
             // Passo 4
             $bot->reply("4️⃣ <strong>Envie os documentos</strong><br>  Envie o formulário preenchido e assinado junto com uma cópia do seu RG para: <strong>colegiados.ccet@ufob.edu.br</strong>");         
             // Dica
             $bot->reply("Você poderá consultar seu processo na página <a href=\"$sigga\" target=\"_blank\">SIGGA</a>, através do mecanismo de busca, por seu nome ou CPF. Também poderá consultá-lo logando no <a href=\"$sipac\" target=\"_blank\">SIPAC</a>, com o mesmo usuário e senha do SIGAA, para ver maiores detalhes como documentos anexados e despachos das unidades.");

         
             $this->showMainContinuar($bot);
         }
    private function handleMatricula(BotMan $bot)
    {
        Log::info('Matrícula keyword detected');
        $question = Question::create('O que você gostaria de saber?')
                ->addButtons([
                Button::create('📝 Como se matricular')->value('como_matricular'),
                Button::create('❓ Manual Matrícula online UFOB')->value('duvidas_matricula'),
            ]);

        $bot->reply($question);
    }

    private function ComoMatricular(BotMan $bot)
         {
          //  $bot->reply("Você escolheu abrir um processo acadêmico. Aqui estão os passos...");
            $TextUrl = asset('assets/abertura.docx'); // Certifique-se de que esta URL é acessível e correta
            $ICPEduUrl = 'https://pessoal.icpedu.rnp.br/home'; // Certifique-se de que esta URL é acessível e correta
            $AssinarUrl= 'https://assinador.iti.br'; // Certifique-se de que esta URL é acessível e correta
            $SecretariaUrl = 'https://ufob.edu.br/a-ufob/unidades-academicas/ccet/fale-conosco'; // Certifique-se de que esta URL é acessível e correta
            $ProtiposUrl = 'https://protic.ufob.edu.br/'; // Certifique-se de que esta URL é acessível e correta            
            // Ajuste a criação da mensagem para incluir o link de forma correta
            //$messageText = "1️⃣ <strong>Preencha o formulário:</strong><br> Baixe e preencha o formulário necessário <a href=\"$TextUrl\">AQUI </a>";
//$message = OutgoingMessage::create($messageText);
            $sipac= 'https://sig.ufob.edu.br/sipac/?modo=classico';

            // Se você deseja enviar o arquivo como anexo
            //$attachment = new File($TextUrl, ['custom_payload' => true,]);
          //  $message->withAttachment($attachment);
            
            // Passo 1
           // $bot->reply($message);
         
             // Passo 2
             $bot->reply("1️⃣ A matrícula web dos estudantes veteranos da UFOB deverá ser realizada via Portal do Estudante do Sistema Integrado de Atividades Acadêmicas (SIGAA).");

    $SIGAAUrl = 'https://sig.ufob.edu.br/sigaa/public/home.jsf'; // URL do SIGAA
    $CalendarioAcademicoUrl = 'https://ufob.edu.br/ensino/agenda-academica'; // URL do Calendário Acadêmico

    // Instruções para a matrícula
    $messageText = "2️⃣Para realizar a matrícula, é preciso acessar o <a href=\"$SIGAAUrl\" target=\"_blank\">site</a> e solicitar a inscrição em turmas. Os prazos das matrículas podem ser verificados no <a href=\"$CalendarioAcademicoUrl\" target=\"_blank\">Calendário Acadêmico</a>.";
    $message = OutgoingMessage::create($messageText);

    // Passo 1 - Acesso ao SIGAA e solicitação de inscrição em turmas
    $bot->reply($message);

    // Passo 2 - Verificação dos prazos no Calendário Acadêmico
    $bot->reply("3️⃣O resultado com a confirmação da matrícula nas disciplinas será publicado na página do estudante no Sistema. Entre os dias de ajustes de matrícula, a lista final com os componentes curriculares em que o estudante está inscrito será divulgada.");

    // Informações adicionais
    $bot->reply("4️⃣ As matriculas de disciplinas será avalida por seu orientador academico, entanto o deferimento será dado pela coordenação de ensino, quem dará prioridades aos alunos do curso da disciplina em caso das disciplinas optativas. Verifique os prazos das matrículas no <a href=\"$CalendarioAcademicoUrl\" target=\"_blank\">Calendário Acadêmico</a>.");

    $this->showMainContinuar($bot);
         }

         
         private function ManualMatricular(BotMan $bot)
         {
          //  $bot->reply("Você escolheu abrir um processo acadêmico. Aqui estão os passos...");
            $TextUrl = asset('assets/ManualSiSU.pdf'); // Certifique-se de que esta URL é acessível e correta
            $messageText = "1️⃣ <strong>Parabéns pela sua aprovação!</strong><br>  Para efetivar sua matrícula na UFOB será necessário que você preencha o formulário eletrônico, no nosso Portal do Ingresso,
seguindo o passo-a-passo descrito abaixo. <a href=\"$TextUrl\">AQUI </a>";
            $message = OutgoingMessage::create($messageText);
            // Se você deseja enviar o arquivo como anexo
            $attachment = new File($TextUrl, ['custom_payload' => true,]);
            $message->withAttachment($attachment);
            
            // Passo 1
            $bot->reply($message);
         }

    private function sayGoodbye(BotMan $bot)
    {
        $bot->reply('Até mais! Se precisar de algo, estou por aqui.');
    }

    

    private function showMainContinuar(BotMan $bot)
    {
        $question = Question::create('Posso ajudar com mais alguma coisa?')
            ->fallback('Não foi possível fazer a pergunta')
            ->callbackId('continuar_menu')
            ->addButtons([
                Button::create('SIM')->value('main_menu'),
                Button::create('NÃO')->value('adeus'),
            ]);

        $bot->reply($question);
    }
}
