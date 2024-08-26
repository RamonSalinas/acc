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
use App\Models\Professor;
use App\Models\User;
use App\Models\Progressao;

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
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\TextInput::make('nome_progressao')
                            ->label('Nome da Progressão')
                            ->disabled()  // Corrigido aqui
                            ->required()
                            ->columnSpan(6), // Ajusta a largura do campo
                        Forms\Components\DatePicker::make('intersticio_data_inicial')
                            ->label('Intersticio Progressão Inicial')
                            ->disabled()  // Corrigido aqui
                            ->required()
                            ->columnSpan(6), // Ajusta a largura do campo
                        Forms\Components\DatePicker::make('intersticio_data_final')
                            ->label('Intersticio Progressão Final')
                            ->disabled()  // Corrigido aqui
                            ->required()
                            ->columnSpan(6), // Ajusta a largura do campo
                        // Adicione outros campos conforme necessário
                    ])
                    ->columns(1), // Define o número de colunas na grade
            ]);
    }

    public static function table(Table $table): Table
    {
        $currentUser = Auth::user();
        $query = Progressao::query();

        if ($currentUser instanceof User) {
            if (!$currentUser->isSuperAdmin()) {
                if ($currentUser->isAdmin() || $currentUser->isAvaliador()) {      
                    $professor = Professor::where('user_id', $currentUser->id)->first();
                    $professorId = $professor ? $professor->id : null;

                    if ($professorId !== null) {
                        $query->where('professor_id', $professorId);
                    }
                } else {
                    dd('somos otra cosa diferente de admin');
                }
            }
        }

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('nome_progressao')
                    ->label('Nome da Progressão')
                    ->alignCenter(), // Centraliza o texto na coluna
                Tables\Columns\TextColumn::make('intersticio_data_inicial')
                    ->label('Intersticio Progressão Inicial')
                    ->date()
                    ->alignCenter(), // Centraliza o texto na coluna
                Tables\Columns\TextColumn::make('intersticio_data_final')
                    ->label('Intersticio Progressão Final')
                    ->date()
                    ->alignCenter(), // Centraliza o texto na coluna
                Tables\Columns\BadgeColumn::make('certificados_count')
                    ->label('Quantidade de Certificados')
                    ->counts('certificados')
                    ->color('success') // Adiciona um badge de cor verde
                    ->alignCenter(), // Centraliza o texto na coluna
            ])
            ->filters([
                // Adicione os filtros da tabela aqui, se necessário
            ])
            ->defaultSort('nome_progressao', 'asc') // Centraliza a tabela
            ->striped(); // Adiciona listras à tabela para melhor visualização
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
                return true;
            }
            if ($user->isAvaliador()) {
                // Se for um Avaliador, retorna true para permitir ver todos os registros
                 return true;
             }
        }
    
        // Se não for nenhum dos casos acima, retorna false por padrão
        return false;
    }




}




