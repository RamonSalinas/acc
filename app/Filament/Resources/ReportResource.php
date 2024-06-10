<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Professor;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Log;

class ReportResource extends Resource
{
    protected static ?string $model = Professor::class;

    protected static ?string $navigationIcon = 'academicon-open-data';
    protected static ?string $navigationLabel = 'Reportes';
    protected static ?string $pluralLabel = 'Reportes';

    public static function boot()
    {
        parent::boot();

        // Tente obter o caminho da imagem
        $imagePath = asset('images/image.png');

        // Verifique se há erro ao obter o caminho da imagem
        if ($imagePath === false) {
            // Se houver erro, registre uma mensagem de log
            Log::error('Erro ao obter o caminho da imagem');
        } else {
            // Se não houver erro, defina o label com a imagem
            static::label('<img src="' . $imagePath . '" alt="Ícone de Relatórios"> Relatórios do Curso');
        }
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
