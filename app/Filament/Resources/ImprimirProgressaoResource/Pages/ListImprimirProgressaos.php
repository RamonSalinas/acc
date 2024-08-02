<?php

namespace App\Filament\Resources\ImprimirProgressaoResource\Pages;

use App\Filament\Resources\ImprimirProgressaoResource;
//use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions;
use Filament\Actions\Action;

class ListImprimirProgressaos extends ListRecords
{
    protected static string $resource = ImprimirProgressaoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('todosCertificados')
                ->label('Todos Certificados')
                ->url(route('progressao.imprimirRelatorio', ['tipo' => 'todos_certificados'])),
            Actions\Action::make('contarRelatorios')
                ->label('Contar Relatórios')
                ->url(route('progressao.imprimirRelatorio', ['tipo' => 'contar_relatorios'])),
            Actions\Action::make('relatoriosUsuario')
                ->label('Relatórios do Usuário')
                ->url(route('progressao.imprimirRelatorio', ['tipo' => 'relatorios_usuario'])),
        ];
    }
}
