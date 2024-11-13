<?php

namespace App\Filament\Resources\NgAtividadesResource\Pages;

use App\Filament\Resources\NgAtividadesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNgAtividades extends EditRecord
{
    protected static string $resource = NgAtividadesResource::class;
    protected function canEdit(): bool
    {
        $user = auth()->user();
        return $user && $user->hasRole(['Super-Admin']);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
