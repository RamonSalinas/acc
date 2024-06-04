<?php

    namespace App\Filament\Resources;
    
    use App\Filament\Resources\NgAtividadesResource\Pages;
    use App\Models\NgAtividades;
    use Filament\Forms;
    use Filament\Forms\Form;
    use Filament\Resources\Resource;
    use Filament\Tables;
    use Filament\Tables\Table;
    use Illuminate\Database\Eloquent\Builder;
    use Spatie\Permission\Traits\HasRoles;

    class NgAtividadesResource extends Resource
    {
        protected static ?string $model = NgAtividades::class;
    
        protected static ?string $navigationIcon = 'academicon-obp';
        protected static ?string $label = 'Atividades';

        public static function form(Form $form): Form

    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('grupo_atividades')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nome_atividade')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('valor_unitario')
                    ->required()
                    ->numeric(),

                Forms\Components\TextInput::make('percentual_maximo')
                    ->required()
                    ->numeric(),
            ]);
    }
    
        public static function table(Table $table): Table
        {
            return $table
                ->columns([
                    Tables\Columns\TextColumn::make('grupo_atividades')
                        ->sortable()
                        ->searchable(),
    
                    Tables\Columns\TextColumn::make('nome_atividade')
                        ->sortable()
                        ->searchable(),
    
                    Tables\Columns\TextColumn::make('valor_unitario')
                        ->sortable()
                        ->searchable(),
    
                    Tables\Columns\TextColumn::make('percentual_maximo')
                        ->sortable()
                        ->searchable(),
    
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable(),
    
                    Tables\Columns\TextColumn::make('updated_at')
                        ->dateTime()
                        ->sortable(),
                ])
                ->filters([
                    // Defina os filtros conforme necessário
                ])
                ->actions([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->bulkActions([
                    Tables\Actions\DeleteBulkAction::make(),
                ]);
        }
    
        public static function getRelations(): array
        {
            return [
                // Defina as relações conforme necessário
            ];
        }
    
        public static function getPages(): array
        {
            return [
                'index' => Pages\ListNgAtividades::route('/'),
                'create' => Pages\CreateNgAtividades::route('/create'),
                'edit' => Pages\EditNgAtividades::route('/{record}/edit'),
            ];
        }
    
        public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user && $user->hasRole(['Super-Admin']);
    }
    
    }




    