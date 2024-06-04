<?php

namespace App\Filament\Resources\NgCertificadosResource\Pages;

use App\Filament\Resources\NgCertificadosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNgCertificados extends ListRecords
{
    protected static string $resource = NgCertificadosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('downloadPdf')
                ->label('Download PDF')
                ->url(route('ng-certificados.pdf'))
                ->color('warning')
                ->icon('academicon-sci-hub-square'),
        ];
    }
}

