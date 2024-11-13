<?php

namespace App\Filament\Resources\PortariaResource\Pages;

use App\Filament\Resources\PortariaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPortarias extends ListRecords
{
    protected static string $resource = PortariaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
