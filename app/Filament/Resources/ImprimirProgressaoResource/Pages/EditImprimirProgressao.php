<?php

namespace App\Filament\Resources\ImprimirProgressaoResource\Pages;

use App\Filament\Resources\ImprimirProgressaoResource;
//use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions;


class EditImprimirProgressao extends EditRecord
{
    protected static string $resource = ImprimirProgressaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ButtonAction::make('gerarRelatorio')
                ->label('Gerar Relatório')
                ->action(function () {
                   // dd($this->record->id);

                    if ($this->record->id) {
                        $this->redirect(route('progressao.analises', ['progressaoId' => $this->record->id]));
                    } else {
                        // Handle the case where progressao_id is missing
                        session()->flash('error', 'Progressao ID is missing.');
                    }
                }),
        ];
    }
}