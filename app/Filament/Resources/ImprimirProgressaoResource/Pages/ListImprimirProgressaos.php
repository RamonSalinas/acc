<?php

namespace App\Filament\Resources\ImprimirProgressaoResource\Pages;

use App\Filament\Resources\ImprimirProgressaoResource;
//use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions;
use Filament\Actions\Action;

class ListImprimirProgressaos extends ListRecords
{
    protected static string $resource = ImprimirProgressaoResource::class;

    protected function getActions(): array
    {
        return [
                   

        ];
    }
}
