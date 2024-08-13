<?php

namespace App\Filament\Resources\ImprimirRelatorioAvaliadorResource\Pages;

use App\Filament\Resources\ImprimirRelatorioAvaliadorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImprimirRelatorioAvaliador extends EditRecord
{
    protected static string $resource = ImprimirRelatorioAvaliadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
