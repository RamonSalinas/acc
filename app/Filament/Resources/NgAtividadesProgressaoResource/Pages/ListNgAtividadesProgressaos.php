<?php

namespace App\Filament\Resources\NgAtividadesProgressaoResource\Pages;

use App\Filament\Resources\NgAtividadesProgressaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNgAtividadesProgressaos extends ListRecords
{
    protected static string $resource = NgAtividadesProgressaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
