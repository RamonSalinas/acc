<?php

namespace App\Filament\Resources\NgCertificadosResource\Pages;

use App\Filament\Resources\NgCertificadosResource;
use Filament\Resources\Pages\EditRecord;

class EditNgCertificados extends EditRecord
{
    protected static string $resource = NgCertificadosResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Adicione aqui qualquer lógica para modificar os dados antes da edição
        return $data;
    }
}
