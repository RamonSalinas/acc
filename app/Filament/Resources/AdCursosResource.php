<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdCursosResource\Pages;
use App\Filament\Resources\AdCursosResource\RelationManagers;
use App\Models\AdCursos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Laravel\Nova\Fields\Select;
class AdCursosResource extends Resource
{
    protected static ?string $model = AdCursos::class;

    protected static ?string $navigationIcon = 'academicon-sci-hub-square';
    
    protected static ?string $label = 'Cursos UFOB';
    protected static ?string $navigationLabel = 'Cursos UFOB';
    protected static ?string $pluralLabel = 'Cursos UFOB';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome_curso')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('carga_horaria_curso')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('carga_horaria_ACC')
                    ->required()
                    ->numeric(),
                    Forms\Components\TextInput::make('carga_horaria_Extensao')
                    ->required(),
                Forms\Components\Select::make('ppc')->options([
                    '2016.1' => '2016.1',
                    '2023.1' => '2023.1',
                ])->required(),
                Forms\Components\TextInput::make('email') // Adicione o campo email aqui
                ->required()
                ->email()
                ->maxLength(255),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_curso')
                    ->searchable(),
                Tables\Columns\TextColumn::make('carga_horaria_curso')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('carga_horaria_ACC')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('carga_horaria_Extensao')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ppc')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                    Tables\Columns\TextColumn::make('email') // Adicione o campo email aqui
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAdCursos::route('/'),
            'create' => Pages\CreateAdCursos::route('/create'),
            'edit' => Pages\EditAdCursos::route('/{record}/edit'),
        ];
    } 
    
    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user && $user->hasRole(['Super-Admin']);
    }


}
