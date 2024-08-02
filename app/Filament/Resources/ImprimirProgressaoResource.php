<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImprimirProgressaoResource\Pages;
use App\Filament\Resources\ImprimirProgressaoResource\RelationManagers;


use App\Models\ImprimirProgressao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Pages\Actions;

class ImprimirProgressaoResource extends Resource
{
  //  protected static ?string $model = ImprimirProgressao::class;
  protected static ?string $navigationIcon = 'academicon-psyarxiv';
    protected static ?string $navigationGroup = 'Gerenciamento de Progressão';
    protected static ?string $label = 'Imprimir Relatórios Progressão';



    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome_progressao')
                    ->label('Nome da Progressão')
                    ->required(),
                Forms\Components\DatePicker::make('data_ultima_progressao')
                    ->label('Data Última Progressão')
                    ->required(),
                // Adicione outros campos conforme necessário
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_progressao')
                    ->label('Nome da Progressão'),
                Tables\Columns\TextColumn::make('data_ultima_progressao')
                    ->label('Data Última Progressão')
                    ->date(),
                // Adicione outras colunas conforme necessário
            ])
            ->filters([
                // Adicione os filtros da tabela aqui, se necessário
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImprimirProgressaos::route('/'),
            'create' => Pages\CreateImprimirProgressao::route('/create'),
            'edit' => Pages\EditImprimirProgressao::route('/{record}/edit'),
        ];
    }
}




