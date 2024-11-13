<?php

namespace App\Filament\Resources\NgCertificadosProgressaoResource\Pages;

use App\Filament\Resources\NgCertificadosProgressaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNgCertificadosProgressao extends EditRecord
{
    protected static string $resource = NgCertificadosProgressaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
