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
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PortariaResource extends Resource
{
    protected static ?string $model = Progressao::class;

    // Remover do painel de navegação e menu
    protected static bool $shouldRegisterNavigation = false;

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

    public static function canViewAny(): bool
    {
        /** @var User $user */
        $user = Auth::user();
    
        // Verifica se o usuário está autenticado
        if ($user) {
            // Verifica se o usuário atual é um Super Admin
            if ($user->isSuperAdmin()) {
                // Se for um Super Admin, retorna true para permitir ver todos os registros
                return false;
            }
    
            // Verifica se o usuário atual é um Admin
            if ($user->isAdmin()) {
                // Se for um Admin, retorna false para não permitir ver todos os registros
                return false;
            }
    
            // Verifica se o usuário atual é um Avaliador
            if ($user->isAvaliador()) {
                // Se for um Avaliador, retorna true para permitir ver todos os registros
                return true;
            }
        }
    
        // Se não for nenhum dos casos acima, retorna false por padrão
        return false;
    }
}