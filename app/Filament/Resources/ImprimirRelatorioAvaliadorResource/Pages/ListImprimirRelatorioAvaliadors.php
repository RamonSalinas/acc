<?php

namespace App\Filament\Resources\ImprimirRelatorioAvaliadorResource\Pages;

use App\Filament\Resources\ImprimirRelatorioAvaliadorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImprimirRelatorioAvaliadors extends ListRecords
{
    protected static string $resource = ImprimirRelatorioAvaliadorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
