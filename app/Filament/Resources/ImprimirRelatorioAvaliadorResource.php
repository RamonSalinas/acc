<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImprimirRelatorioAvaliadorResource\Pages;
use App\Filament\Resources\ImprimirRelatorioAvaliadorResource\RelationManagers;
use App\Models\ImprimirRelatorioAvaliador;
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

class ImprimirRelatorioAvaliadorResource extends Resource
{
    protected static ?string $navigationIcon = 'mdi-printer-outline';
    protected static ?string $navigationGroup = 'Avaliação de Progressão';
    protected static ?string $label = 'Imprimir Relatórios';

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
                if ($currentUser->isAvaliador()) {
                    $currentUser = Auth::user();
                    // Obter o professor associado ao usuário atual
                    $professor = Professor::where('user_id', $currentUser->id)->first();
                    $professorId = $professor ? $professor->id : null;
    
                    if ($professor) {
                        $userId = $professor->user_id;
                    } else {
                        dd('Professor não encontrado');
                    }
    
                    $userIds = User::where('id_professor', $userId)->pluck('id')->toArray();
                    $professorIds = Professor::whereIn('user_id', $userIds)->pluck('id')->toArray();
    
                    $progressaoQuery = Progressao::whereIn('professor_id', $professorIds)
                        ->selectRaw('*, DATEDIFF(intersticio_data_final, intersticio_data_inicial) as progressao');
    
                    $query = $progressaoQuery;
                } else {
                    dd('entro no else porque no encontro nada para imprimir?');
                }
            }
        }
    
        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('professor.user.name')
                    ->label('ID Professor')
                    ->sortable()
                    ->searchable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('nome_progressao')
                    ->label('ID Progressão')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('intersticio_data_inicial')
                    ->label('Intersticio Progressão Inicial')
                    ->date()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('intersticio_data_final')
                    ->label('Intersticio Progressão Final')
                    ->date()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('progressao')
                    ->label('Progressão')
                    ->getStateUsing(function ($record) {
                        $start = \Carbon\Carbon::parse($record->intersticio_data_inicial);
                        $end = \Carbon\Carbon::parse($record->intersticio_data_final);
                        return $start->diffInDays($end) . ' dias';
                    })
                    ->alignCenter(),
                Tables\Columns\BadgeColumn::make('certificados_count')
                    ->label('Quantidade de Certificados')
                    ->counts('certificados')
                    ->color('success') // Adiciona um badge de cor verde
                    ->alignCenter(),
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
            'index' => Pages\ListImprimirRelatorioAvaliadors::route('/'),
            'create' => Pages\CreateImprimirRelatorioAvaliador::route('/create'),
            'edit' => PortariaResource\Pages\EditPortaria::route('/{record}/edit'), // Alterado para usar EditPortaria

 //           'edit' => Pages\EditImprimirRelatorioAvaliador::route('/{record}/edit'),
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
               return true;
           }
        }
    
        // Se não for nenhum dos casos acima, retorna false por padrão
        return false;
    }

}
