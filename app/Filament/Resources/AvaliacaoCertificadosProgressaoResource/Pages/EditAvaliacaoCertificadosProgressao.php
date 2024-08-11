<?php

namespace App\Filament\Resources\AvaliacaoCertificadosProgressaoResource\Pages;

use App\Filament\Resources\AvaliacaoCertificadosProgressaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAvaliacaoCertificadosProgressao extends EditRecord
{
    protected static string $resource = AvaliacaoCertificadosProgressaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
