<?php

namespace App\Filament\Resources\ImprimirRelatorioAvaliadorResource\Pages;

use App\Filament\Resources\ImprimirRelatorioAvaliadorResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\ButtonAction;
use Filament\Pages\Actions;

class EditImprimirRelatorioAvaliador extends EditRecord
{
    protected static string $resource = ImprimirRelatorioAvaliadorResource::class;

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

    public function getFormActions(): array  //esta funciona tirou o botão da parite inferior  mas não mostra o novo botão mas não tem problema sob ver que não afecte na frete o ssitema 
    {
        return [
            Actions\ButtonAction::make('voltar') 
                ->label('Voltar')
                ->url(ImprimirRelatorioAvaliadorResource::getUrl('index'))
                ->color('secondary'),
        ];
    }
}