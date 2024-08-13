<?php

namespace App\Filament\Resources\ImprimirRelatorioAvaliadorResource\Pages;

use App\Filament\Resources\ImprimirRelatorioAvaliadorResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\ButtonAction;

class EditImprimirRelatorioAvaliador extends EditRecord
{
    protected static string $resource = ImprimirRelatorioAvaliadorResource::class;

    public function getFormActions(): array
    {
        return [
            ButtonAction::make('save')
                ->label('Salvar')
                ->submit('save')
                ->hidden()
                ->color('primary'),

            ButtonAction::make('cancel')
                ->label('Cancelar')
                ->url($this->getResource()::getUrl('index'))
                ->hidden()
                ->color('secondary'),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            ButtonAction::make('gerarRelatorio')
                ->label('Gerar Relatório')
                ->action(function () {
                    if ($this->record->id) {
                        $this->redirect(route('progressao.analises', ['progressaoId' => $this->record->id]));
                    } else {
                        session()->flash('error', 'Progressao ID is missing.');
                    }
                }),
        ];
    }
}