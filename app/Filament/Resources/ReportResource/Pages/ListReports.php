<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('downloadPdf')
                ->label('Download PDF')
                ->url(route('reports.pdf'))
                ->color('warning')
                ->icon('academicon-openedition'),
        ];
    }

    protected function getFooterActions(): array
    {
        return [
            Actions\Action::make('downloadPdfFooter')
                ->label('Download PDF')
                ->url(route('reports.pdf'))
                ->color('warning')
                ->icon('academicon-openedition'),
        ];
    }
}

