<?php

namespace App\Filament\Resources\NgAtividadesProgressaoResource\Pages;

use App\Filament\Resources\NgAtividadesProgressaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNgAtividadesProgressao extends EditRecord
{
    protected static string $resource = NgAtividadesProgressaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
