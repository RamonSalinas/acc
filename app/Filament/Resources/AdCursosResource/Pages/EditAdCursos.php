<?php

namespace App\Filament\Resources\AdCursosResource\Pages;

use App\Filament\Resources\AdCursosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdCursos extends EditRecord
{
    protected static string $resource = AdCursosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
