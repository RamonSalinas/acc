<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NgCertificadosResource\Pages;
use App\Models\NgCertificados;  
use App\Models\NgAtividades;
use App\Models\AdCursos;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NgCertificadosResource extends Resource
{
    protected static ?string $model = NgCertificados::class;

    protected static ?string $navigationIcon = 'phosphor-certificate-duotone';
    protected static ?string $label = 'Certificados';
    protected static ?string $navigationLabel = 'Certificados';
    protected static ?string $pluralLabel = 'Certificados';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('grupo_atividades')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                        '8' => '8',
                    ])
                    ->required()
                    ->reactive()
                    ->default('1')
                    ->afterStateUpdated(function (callable $set) {
                        $set('id_tipo_Atividade', null);
                        $set('valor_unitario', null);
                        $set('percentual_maximo', null);
                        $set('horas_ACC', null);
                    }),

                Forms\Components\Select::make('id_tipo_Atividade')
                    ->label('Nome da Atividade')
                    ->required()
                    ->reactive()
                    ->options(function (callable $get) {
                        $grupoAtividades = $get('grupo_atividades');
                        if ($grupoAtividades) {
                            return NgAtividades::where('grupo_atividades', $grupoAtividades)
                                ->pluck('nome_atividade', 'id')
                                ->toArray();
                        }
                        return [];
                    })
                    ->afterStateUpdated(function (callable $set, callable $get, $state) {
                        $set('horas_ACC', null);  // Reset horas_ACC to null

                        if ($state) {
                            $atividade = NgAtividades::find($state);
                            if ($atividade) {
                                $set('valor_unitario', $atividade->valor_unitario);
                                $set('percentual_maximo', $atividade->percentual_maximo);

                                if (in_array($state, [7, 9, 15])) {
                                    Notification::make()
                                        ->title('Atividade Especial Selecionada')
                                        ->body('Você selecionou uma atividade especial. Agregue o número de atividades realizadas.')
                                        ->success()
                                        ->send();
                                }
                            }
                        }
                    }),

                Forms\Components\TextInput::make('valor_unitario')
                    ->label('Valor Unitário')
                    ->disabled()
                    ->reactive()
                    ->dehydrated(false),

                Forms\Components\TextInput::make('percentual_maximo')
                    ->label('Percentual Máximo')
                    ->disabled()
                    ->dehydrated(false),

                Forms\Components\TextInput::make('nome_certificado')
                    ->required()
                    ->default('NOME TESTE')
                    ->maxLength(255),

                Forms\Components\TextInput::make('carga_horaria')
                    ->label(fn (callable $get) => $get('carga_horaria_label', 'Horario'))
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $idTipoAtividade = $get('id_tipo_Atividade');
                        $valorUnitario = $get('valor_unitario');
                        $cargaHoraria = $get('carga_horaria');
                        $percentualMaximo = $get('percentual_maximo');
                        
                        $user = Auth::user();
                        $curso = AdCursos::find($user->id_curso);

                        if (!$curso) {
                            Notification::make()
                                ->title('Erro')
                                ->body('Curso não encontrado.')
                                ->danger()
                                ->send();
                            return;
                        }

                        $maxHorasPermitidas = ($curso->carga_horaria_ACC * $percentualMaximo) / 100;
                        if ($idTipoAtividade && in_array($idTipoAtividade, [7, 9, 15])) {
                            $horasACC = $valorUnitario * $cargaHoraria;

                            if ($horasACC > $maxHorasPermitidas) {
                                Notification::make()
                                    ->title('Excedeu o limite permitido')
                                    ->body('Só será contemplado o máximo porcentagem do barema do CCET.')
                                    ->warning()
                                    ->send();
                            }
                            $set('horas_ACC', $horasACC);
                        } else {
                            $horasACC = $cargaHoraria / $valorUnitario;

                            if ($horasACC > $maxHorasPermitidas) {
                                Notification::make()
                                    ->title('Excedeu o limite permitido')
                                    ->body('Só será contemplado o máximo porcentagem do barema do CCET.')
                                    ->warning()
                                    ->send();
                            }
                            $set('horas_ACC', $horasACC);
                        }
                    }),

                    

                Forms\Components\Textarea::make('descricao')
                    ->default('TESTE DESCRIÇÃO'),

                Forms\Components\TextInput::make('local')
                    ->required()
                    ->default('TESTE BARREIRA')
                    ->maxLength(255),

                Forms\Components\DatePicker::make('data_inicio')
                    ->default(Carbon::now())
                    ->required(),

                Forms\Components\DatePicker::make('data_final')
                    ->default(Carbon::now())
                    ->required(),

                Forms\Components\Hidden::make('id_usuario')
                    ->default(fn () => Auth::id()),

                Forms\Components\TextInput::make('horas_ACC')//Teve que criar um hidden  do mesmo valor já que quando coloco disable, o valor não é enviado e da erro no banco de dados. 
                ->label('Horas ACC Equivalentes')
                ->default(0)
                ->disabled()
                ->extraAttributes(['hidden' => 'hidden']),
                Forms\Components\Hidden::make('horas_ACC')
                ->default(0),
                    

                Forms\Components\TextInput::make('type')
                    ->default('pendente')
                    ->disabled()
                    ->required(),


             
                    
            ]);
    }

    public static function table(Table $table): Table
{
    $currentUser = Auth::user();

    $query = static::getModel()::query();

    // Verifica se o usuário é um Super Admin
    if (!$currentUser->isSuperAdmin()) {
        // Verifica se o usuário é um Admin
        if ($currentUser->isAdmin()) {
            // Se for, filtra os registros pelo id_professor igual ao ID do Admin
            $query->whereHas('user', function ($query) use ($currentUser) {
                $query->where('id_professor', $currentUser->id);
            });
        } else {
            // Se não for um Super Admin ou Admin, filtra os registros pelo ID do usuário atual
            $query->where('id_usuario', $currentUser->id);
        }
    }

    return $table
        ->query($query)
        ->columns([
            Tables\Columns\TextColumn::make('nome_certificado')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('carga_horaria')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('type')
                ->badge()->colors([
                    'pendente' => 'gray',
                    'aprovado' => 'green',
                    'reprovado' => 'red',
                ])->searchable(),
            Tables\Columns\TextColumn::make('descricao')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('local')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('data_inicio')->date()->sortable()->searchable(),
            Tables\Columns\TextColumn::make('data_final')->date()->sortable()->searchable(),
            Tables\Columns\TextColumn::make('ngAtividade.nome_atividade')->label('Atividade')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('user.name')->label('Usuário')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('horas_ACC')->sortable()->searchable(),
        ])
        ->filters([
            // Defina os filtros, se necessário
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
            'index' => Pages\ListNgCertificados::route('/'),
            'create' => Pages\CreateNgCertificados::route('/create'),
            'edit' => Pages\EditNgCertificados::route('/{record}/edit'),
        ];
    }

    
}
