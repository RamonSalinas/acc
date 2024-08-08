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

        $query = static::getModel()::query();

        if ($currentUser instanceof User) {
            if (!$currentUser->isSuperAdmin()) {
                if ($currentUser->isAdmin()) {
                    //$query->whereHas('professor', function ($query) use ($currentUser) {
                        $professor = Professor::where('user_id', $currentUser->id)->first();
                        $professorId = $professor ? $professor->id : null;
                    
                        // Defina a consulta para a tabela
                        $query = Progressao::query();
                    
                        if ($professorId !== null) {
                            $query->where('professor_id', $professorId);
                        }
                                                   
                    
                    $query->whereHas('professor', function ($query) use ($currentUser) {

                                            
                    });
                   // dd($currentUser->id_professor);
                } else {
                    dd('somos otra cosa diferente de admin');
                }
            }
        }







        return $table
        ->query($query)   
            ->columns([
                Tables\Columns\TextColumn::make('nome_progressao')
                    ->label('Nome da Progressão'),
                    Tables\Columns\TextColumn::make('intersticio_data_inicial')
                    ->label('Intersticio Progressão Inicial')
                    ->date(),
                Tables\Columns\TextColumn::make('intersticio_data_final')
                    ->label('Intersticio Progressão Final')
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




