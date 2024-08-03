<?php

namespace App\Filament\Resources\ImprimirProgressaoResource\Pages;

use App\Filament\Resources\ImprimirProgressaoResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions;
use Filament\Pages\Actions\ButtonAction;

class EditImprimirProgressao extends EditRecord
{
    protected static string $resource = ImprimirProgressaoResource::class;

    public function getTitle(): \Illuminate\Contracts\Support\Htmlable|string
    {
        return 'Criar Novo Relatório Detalhado'; // Título da página de criação
    }

    public function getFormActions(): array
    {
        return [
            Actions\ButtonAction::make('save')
                ->label('Salvar')
                ->submit('save')
                ->hidden()
                ->color('primary'),

            Actions\ButtonAction::make('cancel')
                ->label('Cancelar')
                ->url($this->getResource()::getUrl('index'))
                ->hidden()
                ->color('secondary'),
        ];
    }
    

    protected function getHeaderActions(): array
    {
        return [
            Actions\ButtonAction::make('gerarRelatorio')
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