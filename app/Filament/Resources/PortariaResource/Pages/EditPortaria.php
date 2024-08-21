<?php

namespace App\Filament\Resources\PortariaResource\Pages;

use App\Filament\Resources\PortariaResource;
use Filament\FilamentServiceProvider;
use Filament\Resources\Pages\EditRecord;

class EditPortaria extends EditRecord
{
    protected static string $resource = PortariaResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return [
            'num_portaria' => $data['num_portaria'],
            'data_portaria' => $data['data_portaria'],
            'arquivo_portaria' => $data['arquivo_portaria'],
        ];
    }
    protected function afterSave(): void
    {
        $this->redirect($this->getResource()::getUrl('editImprimirRelatorioAvaliador', ['record' => $this->record->getKey()]));
    }
} 

