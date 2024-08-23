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
use Illuminate\Support\Facades\Auth; // Adicione esta linha
use App\Models\User; // Adicione esta linha

class AdCursosResource extends Resource
{
    protected static ?string $model = AdCursos::class;

    protected static ?string $navigationIcon = 'academicon-sci-hub-square';
    
    protected static ?string $label = 'Cursos UFOB';
    protected static ?string $navigationLabel = 'Cursos UFOB';
    protected static ?string $navigationGroup = 'Orientaçãoes Academicas';

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
        /** @var User $user */
        $user = Auth::user();
    
        // Verifica se o usuário está autenticado
        if ($user) {
            // Verifica se o usuário atual é um Super Admin
            if ($user->isSuperAdmin()) {
                // Se for um Super Admin, retorna true para permitir ver todos os registros
                return true;
            }
    
            // Verifica se o usuário atual é um Admin
            if ($user->isAdmin()) {
                // Se for um Admin, retorna false para não permitir ver todos os registros
                return false;
            }
    
            // Verifica se o usuário atual é um Avaliador
           if ($user->isAvaliador()) {
              // Se for um Avaliador, retorna true para permitir ver todos os registros
               return false;
           }
  // Verifica se o usuário atual é um Alumnos
            if ($user->isEspecialista()) {
                // Se for um Avaliador, retorna true para permitir ver todos os registros
                return false;
            }
 
            if ($user->isCoordenador()) {
             // Se for um Avaliador, retorna true para permitir ver todos os registros
             return true;
         }
 
        }
    
        // Se não for nenhum dos casos acima, retorna false por padrão
        return false;
    }

}


