<?php

namespace App\Filament\Resources\NgAtividadesResource\Pages;

use App\Filament\Resources\NgAtividadesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNgAtividades extends ListRecords
{
    protected static string $resource = NgAtividadesResource::class;
    protected function canViewAny(): bool
    {
        $user = auth()->user();
        return $user && $user->hasRole(['Super-Admin']);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
