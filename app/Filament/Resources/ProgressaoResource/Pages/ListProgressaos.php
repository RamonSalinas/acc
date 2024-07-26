<?php

namespace App\Filament\Resources\ProgressaoResource\Pages;

use App\Filament\Resources\ProgressaoResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Table; // Certifique-se de importar a classe correta
use Filament\Actions;

class ListProgressaos extends ListRecords
{
    protected static string $resource = ProgressaoResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_progressao')
                    ->label('Nome da Progressão'),
                Tables\Columns\TextColumn::make('intersticio_data_inicial')
                    ->label('Interstício Data Inicial')
                    ->date(),
                Tables\Columns\TextColumn::make('intersticio_data_final')
                    ->label('Interstício Data Final')
                    ->date(),
                Tables\Columns\TextColumn::make('classe')
                    ->label('Classe'),
                Tables\Columns\TextColumn::make('regime')
                    ->label('Regime'),
                Tables\Columns\TextColumn::make('nivel')
                    ->label('Nível'),
                Tables\Columns\TextColumn::make('data_ultima_progressao')
                    ->label('Data Última Progressão')
                    ->date(),
            ])
            ->filters([
                // Adicione filtros aqui, se necessário
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}