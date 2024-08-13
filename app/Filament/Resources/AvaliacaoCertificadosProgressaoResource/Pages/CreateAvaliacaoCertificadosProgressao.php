<?php

namespace App\Filament\Resources\AvaliacaoCertificadosProgressaoResource\Pages;

use App\Filament\Resources\AvaliacaoCertificadosProgressaoResource;
use Filament\Actions;
use App\Filament\Resources\NgCertificadosResource;

use Filament\Resources\Pages\CreateRecord;

class CreateAvaliacaoCertificadosProgressao extends CreateRecord
{
    protected static string $resource = AvaliacaoCertificadosProgressaoResource::class;

    protected function getCreateAction()
    {
        return Actions\ButtonAction::make('create')
            ->label('Criar')
            ->action('create')
            ->color('primary');
    }




}
