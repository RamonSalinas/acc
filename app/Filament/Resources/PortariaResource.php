<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PortariaResource\Pages;
use App\Models\Progressao;
use Filament\Forms;
use Filament\Forms\Form; // Importação correta
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table; // Importação correta
use Filament\Tables\Columns\TextColumn;

class PortariaResource extends Resource
{
    protected static ?string $model = Progressao::class;

    protected static ?string $navigationIcon = 'mdi-code-block-braces';
    protected static ?string $navigationGroup = 'Avaliação de Progressão';
    protected static ?string $label = 'Porteria';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('num_portaria')
                    ->label('Número da Portaria')
                    ->required(),
                Forms\Components\DatePicker::make('data_portaria')
                    ->label('Data da Portaria')
                    ->required(),
                Forms\Components\FileUpload::make('arquivo_portaria')
                    ->label('Arquivo da Portaria')
                    ->required(),

                Forms\Components\TextInput::make('nome_progressao')
                ->label('ID Progressão')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('nome_progressao')
                    ->label('Nome da Progressão')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('num_portaria')
                    ->label('Número da Portaria')
                    ->sortable()
                    ->searchable(),

              
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPortarias::route('/'),
            'edit' => Pages\EditPortaria::route('/{record}/edit'),
            'editImprimirRelatorioAvaliador' => ImprimirRelatorioAvaliadorResource\Pages\EditImprimirRelatorioAvaliador::route('/{record}/edit'),
        ];
    }
}