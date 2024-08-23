<?php

namespace App\Filament\Resources\ImprimirRelatorioAvaliadorResource\Pages;

use App\Filament\Resources\ImprimirRelatorioAvaliadorResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\ButtonAction;
use Filament\Pages\Actions;
use App\Models\PontosProgressao;
use Filament\Notifications\Notification;
use App\Models\Progressao;
use App\Models\Professor;
use App\Models\User;
use App\Models\AdGrupoProgressao;
class EditImprimirRelatorioAvaliador extends EditRecord
{
    protected static string $resource = ImprimirRelatorioAvaliadorResource::class;
    public function mount($record): void
    {
        
        //dd('DD Edit IMPRIMIR RELATORIO AVALIADOR',$record);

        parent::mount($record);
        $this->verificarEContinuar();
    }
    public function verificarPontos($progressaoId)
    { 
   $progressaoId = $progressaoId->id;
   $progressao = Progressao::find($progressaoId);


   //dd('DD Edit',$progressao);
    if ($progressaoId instanceof \Illuminate\Database\Eloquent\Collection) {
        $progressaoId = $progressaoId->first();
    }




    
    $professorID = $progressao->professor_id;
   // dd('DD Edit',$professorID);

   // $professorID = 15;

    // Verifique se a progressão foi encontrada


    // Encontre o professor associado à progressão


   // dd('DD Edit',$progressaoId);

    // Encontre a progressão
    $progressao = Progressao::find($progressaoId);
    
    
    if ($progressao instanceof \Illuminate\Database\Eloquent\Collection) {
        $progressao = $progressao->first();
    }

    // Verifique se a progressão foi encontrada
    if (!$progressao) {
        throw new \Exception("Progressão não encontrada");
    }

    // Encontre o professor associado à progressão
    $professorID = $progressao->professor_id;
    $professor = Professor::find($professorID);

    if (!$professor) {
        throw new \Exception("Professor não encontrado");
    }

    $professorIDuser = $professor->user_id;

    // Encontre o usuário associado ao professor
    $user = User::find($professorIDuser);

    if (!$user) {
        throw new \Exception("Usuário não encontrado");
    }

    $userId = $user->id; // Id do professor da Progressão para imprimir o relatório e dados certos

    // Obtenha os grupos adequados
    $grupos = AdGrupoProgressao::with(['ngCertificadosProgressao' => function($query) use ($userId, $progressaoId) {
        $query->where('id_usuario', $userId)
              ->where('progressao_id', $progressaoId);
    }, 'ngCertificadosProgressao.adGrupoProgressao'])->get();

    //dd($grupos);

    // Encontre os pontos de progressão
    $pontosProgressao = PontosProgressao::where('classe', $progressao->classe)
        ->where('nivel', $progressao->nivel)
        ->first();

    $pontos = $pontosProgressao ? $pontosProgressao->pontos : 'N/A';

    // Calcule a pontuação total do avaliador
    $totalPontuacaoAvaliadorController = 0.0;
    foreach ($grupos as $grupo) {
        foreach ($grupo->ngCertificadosProgressao as $certificado) {
            if ($certificado->status != 'Pendente' && $certificado->status != 'Rejeitada') {
                $totalPontuacaoAvaliadorController += floatval($certificado->pontuacao_avaliador);
            }
        }
    }

  //  dd($totalPontuacaoAvaliadorController, $pontos);

    return $totalPontuacaoAvaliadorController >= $pontos;
}

    public function verificarEContinuar()
    {
        $progressao = $this->record;
        $pontosSuficientes = $this->verificarPontos($progressao);


        if (!$pontosSuficientes) {
            Notification::make()
                ->title('Aviso')
                ->body('A pontuação registrada e avaliada até o momento não é suficiente para cumprir o requisito ou nível solicitado. Você ainda pode optar por emitir os certificados, se desejar. Deseja continuar?')
                ->warning()
                ->send();
        } else {
            Notification::make()
                ->title('Sucesso')
                ->body('A pontuação registrada e avaliada é adequada para cumprir o requisito ou nível solicitado. Continuando o processo.')
                ->success()
                ->send();
        }
    }

    public function getTitle(): \Illuminate\Contracts\Support\Htmlable|string
    {
        return 'Criar Novo Relatório Detalhado'; // Título da página de criação
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Parecer_Conclusivo')
                ->label('Parecer Conclusivo')
                ->url(route('progressao.imprimirRelatorio', ['tipo' => 'Parecer_Conclusivo', 'progressaoId' => $this->record->id]))
                ->color('info')
                ->icon('heroicon-o-document-text'),

            Actions\Action::make('contarRelatorios')
                ->label('Relatórios Desempenho')
                ->url(route('progressao.imprimirRelatorio', ['tipo' => 'contar_relatorios', 'progressaoId' => $this->record->id]))
                ->color('warning')
                ->icon('heroicon-o-document-text'),

            Actions\ButtonAction::make('gerarRelatorio')
                ->label('Gerar Relatório Avaliador')
                ->url(route('progressao.imprimirRelatorio', ['tipo' => 'analises', 'progressaoId' => $this->record->id])),

            Actions\ButtonAction::make('relatorioAvaliacao')
                ->label('Relatorio de Avaliação Avaliador')
                ->color('success')
                ->icon('heroicon-o-document-text')
                ->action(function () {
                    if ($this->record->id) {
                        $this->redirect(route('progressao.imprimirRelatorio', ['tipo' => 'relatorioavaliacao', 'progressaoId' => $this->record->id]));
                    } else {
                        session()->flash('error', 'Progressao ID is missing.');
                    }
                }),
        ];
    }

    protected function afterSave(): void
    {
        $this->redirect(ImprimirRelatorioAvaliadorResource::getUrl('index'));
    }

    public function getFormActions(): array
    {
        return [
            Actions\ButtonAction::make('voltar') 
                ->label('Voltar')
                ->url(ImprimirRelatorioAvaliadorResource::getUrl('index'))
                ->color('secondary'),
        ];
    }
}