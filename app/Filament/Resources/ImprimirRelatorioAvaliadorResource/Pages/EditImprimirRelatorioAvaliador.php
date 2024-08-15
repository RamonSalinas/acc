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
            Actions\Action::make('relatoriosUsuario')
                ->label('Requerimento Avaliador')
                ->url(route('progressao.imprimirRelatorio', ['tipo' => 'relatorios_usuario', 'progressaoId' => $this->record->id])),
    
            Actions\ButtonAction::make('gerarRelatorio')
                ->label('Gerar Relatório Avaliador')
                ->url(route('progressao.imprimirRelatorio', ['tipo' => 'analises',  'progressaoId' => $this->record->id])),

              // ->action(function () {
               //     if ($this->record->id) {
               //         $this->redirect(route('progressao.imprimirRelatorio', ['tipo' => 'analises', 'progressaoId' => $this->record->id]));
               //     } else {
               //         session()->flash('error', 'Progressao ID is missing.');
                 //   }
               // }),
    
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

}