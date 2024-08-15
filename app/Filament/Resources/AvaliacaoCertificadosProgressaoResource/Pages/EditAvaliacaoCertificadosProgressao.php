<?php

namespace App\Filament\Resources\AvaliacaoCertificadosProgressaoResource\Pages;

use App\Filament\Resources\AvaliacaoCertificadosProgressaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;


class EditAvaliacaoCertificadosProgressao extends EditRecord
{
    protected static string $resource = AvaliacaoCertificadosProgressaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Baixar')
            ->label('Baixar Arquivo')
            ->url(fn() => $this->record->arquivo_progressao ? asset('storage/' . $this->record->arquivo_progressao) : null)
            ->icon('phosphor-certificate-duotone')
            ->openUrlInNewTab()
            ->visible(fn() => $this->record->arquivo_progressao !== null),
    ];
    }
}
