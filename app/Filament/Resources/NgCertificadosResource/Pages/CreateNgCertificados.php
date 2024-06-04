<?php

namespace App\Filament\Resources\NgCertificadosResource\Pages;

use App\Filament\Resources\NgCertificadosResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNgCertificados extends CreateRecord
{
    protected static string $resource = NgCertificadosResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Adicione aqui qualquer lógica para modificar os dados antes da criação
        return $data;
    }
}
