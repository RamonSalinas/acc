<?php

namespace App\Filament\Resources\ProgressaoResource\Pages;

use App\Filament\Resources\ProgressaoResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table; // Certifique-se de importar a classe correta
use Filament\Actions;

class ListProgressaos extends ListRecords
{
    protected static string $resource = ProgressaoResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    
}