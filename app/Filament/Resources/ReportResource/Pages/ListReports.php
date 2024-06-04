<?php



namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;
use App\Http\Controllers\ReportPdfController;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('downloadPdf')
                ->label('Download PDF')
                ->url(route('reports.pdf'))
                ->color('secondary')
                ->icon('academicon-openedition'),
        ];
    }
}

