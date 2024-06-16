<?php

namespace App\Filament\Resources\NgCertificadosResource\Pages;

use App\Filament\Resources\NgCertificadosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListNgCertificados extends ListRecords
{
    protected static string $resource = NgCertificadosResource::class;

    protected function getHeaderActions(): array
    {
        $currentUser = Auth::user();
    
        // Verifica se o usuário é um super administrador
        if ($currentUser->isSuperAdmin()) {
            // Se for um super administrador, retorna ambos os botões
            return [
                Actions\CreateAction::make(),
                Actions\Action::make('downloadPdf')
                    ->label('Download PDF')
                    ->url(route('ng-certificados.pdf'))
                    ->color('warning')
                    ->icon('academicon-sci-hub-square'),
            ];
        }
    
        // Verifica se o usuário é um administrador
        if ($currentUser->isAdmin()) {
            // Se for um administrador, retorna apenas o botão de download do PDF
            return [
                Actions\Action::make('downloadPdf')
                    ->label('Download PDF')
                    ->url(route('ng-certificados.pdf'))
                    ->color('warning')
                    ->icon('academicon-sci-hub-square'),
            ];
        }
    
        // Se não for um super administrador nem um administrador, retorna ambos os botões
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

