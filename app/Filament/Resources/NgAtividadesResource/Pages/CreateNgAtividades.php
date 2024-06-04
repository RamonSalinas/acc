<?php

namespace App\Filament\Resources\NgAtividadesResource\Pages;

use App\Filament\Resources\NgAtividadesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNgAtividades extends CreateRecord
{
    protected static string $resource = NgAtividadesResource::class;
    protected function canCreate(): bool
    {
        $user = auth()->user();
        return $user && $user->hasRole(['Super-Admin']);
    }
}
