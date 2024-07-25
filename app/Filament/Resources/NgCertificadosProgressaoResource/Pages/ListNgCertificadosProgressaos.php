<?php

namespace App\Filament\Resources\NgCertificadosProgressaoResource\Pages;

use App\Filament\Resources\NgCertificadosProgressaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNgCertificadosProgressao extends ListRecords
{
    protected static string $resource = NgCertificadosProgressaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
