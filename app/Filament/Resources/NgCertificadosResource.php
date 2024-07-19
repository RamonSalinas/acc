<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NgCertificadosResource\Pages;
use App\Models\NgCertificados;  
use App\Models\NgAtividades;
use App\Models\AdCursos;
use App\Models\AdGrupo;
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
                ->label('Grupo de Atividades')
                ->options(function () {
                    // Carregue os dados diretamente do banco de dados
                    return AdGrupo::pluck('nome_grupo', 'id')->toArray();
                })
                    ->required()
                    ->reactive()
                    ->searchable()
                    ->label('Grupo de Atividades')
                    ->getSearchResultsUsing(function (string $search): array {
                        $results = AdGrupo::where('nome_grupo', 'like', "%{$search}%")->limit(50)->get();
                        return $results->pluck('nome_grupo', 'id')->toArray();
                    })
                    ->getOptionLabelUsing(fn ($value): ?string => AdGrupo::find($value)?->nome_grupo)
                    ->afterStateUpdated(function (callable $set) {
                        $set('id_tipo_Atividade', null);
                        $set('valor_unitario', null);
                        $set('percentual_maximo', null);
                        $set('horas_ACC', null);
                        $set('carga_horaria', null);
                    }),

            Forms\Components\Select::make('id_tipo_atividade')
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
            ->default(function ($record) {
                return $record ? $record->id_tipo_atividade : null;
            })
            ->afterStateUpdated(function (callable $set, callable $get, $state) {
                $set('horas_ACC', null);
                $set('carga_horaria', null);
                

                if ($state) {
                    $atividade = NgAtividades::find($state);
                    if ($atividade) {
                        $set('valor_unitario', $atividade->valor_unitario);
                        $set('percentual_maximo', $atividade->percentual_maximo);

                        if (in_array($state, [7, 9, 15,80,82,83,13,14,15,16,17,18,19,20,21,23,25,26,27,28,29,32,33,34,35,36,37,39,40,41,43,44,45,50,53,54,55,56,57,58,59,60,61,62,65,66,67,68,69,70,71,72,73,74])) {

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
                    ->dehydrated(false)
                    ->hidden(),
    
                Forms\Components\TextInput::make('percentual_maximo')
                    ->label('Percentual Máximo')
                    ->disabled()
                    ->dehydrated(false)
                    ->hidden(),
                
    
                Forms\Components\TextInput::make('nome_certificado')
                    ->required()
                   ->default('NOME TESTE')
                    ->maxLength(255),
    
                Forms\Components\TextInput::make('carga_horaria')
                    ->label(fn (callable $get) => $get('carga_horaria_label', 'Horario'))
                    ->required()
                    ->reactive()
                    ->numeric() // Ensure only numeric values
                    ->rule('min:1') // Ensure the value is   maior que 0
    ->afterStateUpdated(function (callable $set, callable $get) {
    $idTipoAtividade = $get('id_tipo_atividade');
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
    
                    if (!$percentualMaximo) {
                        Notification::make()
                            ->title('Erro')
                            ->body('Percentual máximo não encontrado.')
                            ->danger()
                            ->send();
                        return;
                    }
    
                    if (!$valorUnitario) {
                        Notification::make()
                            ->title('Erro')
                            ->body('Valor unitário não encontrado.')
                            ->danger()
                            ->send();
                        return;
                    }
    
                    if (!$cargaHoraria) {
                        Notification::make()
                            ->title('Erro')
                            ->body('Carga horária não encontrada.')
                            ->danger()
                            ->send();
                        return;
                    }
//LOGICA PARA CALCULAR AS HORAS ACC DE MANEIRA CERTO NO CASO QUE O USUARIO SELECIONE UMA ATIVIDADE ESPECIAL MULTIPLE BEM A CARGA REGISTRADA
                    $maxHorasPermitidas = ($curso->carga_horaria_ACC * $percentualMaximo) / 100;
                   
                    $grupoA = [7, 9, 15, 80, 82, 83, 13, 14, 15, 16, 17, 18, 19, 20, 21, 23, 25, 26, 27, 28, 29, 32, 33, 34, 35, 36, 37, 39, 40, 41, 43, 44, 45, 50, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74];//Grupo de atividades com bastante horas de carga 
                    $grupoB = [5, 6, 52, 64, 48, 8, 51, 12, 22, 30, 76, 78, 81]; // Valores de atividades especiais com carga horária  menores
                   
                    if ($idTipoAtividade && (in_array($idTipoAtividade, $grupoA) || in_array($idTipoAtividade, $grupoB))) {
                        // Cálculo das horas para os grupos A e B
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
                        // Cálculo das horas para outros casos
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
                ->default('TESTE DE FUEGO'),
    
            Forms\Components\TextInput::make('local')
                ->required()
                ->default('Truijillo')
                ->maxLength(255),
    
            Forms\Components\DatePicker::make('data_inicio')
                ->default(Carbon::now())
                ->required(),
    
            Forms\Components\DatePicker::make('data_final')
                ->default(Carbon::now())
                ->required(),

                Forms\Components\FileUpload::make('arquivo')
                    ->label('Arquivo')
                    ->disk('public')
                    ->directory('certificados')
                    ->acceptedFileTypes(['image/*', 'application/pdf'])
                    ->maxSize(10240) // Limite de tamanho de 10 MB
                    ->required(),
    
            Forms\Components\Hidden::make('id_usuario')
                ->default(fn () => Auth::id()),
    
            Forms\Components\TextInput::make('horas_ACC') // This hidden field ensures the value is sent to the database
                ->label('Horas ACC Equivalentes')
                ->default(0)
                ->disabled()
                ->extraAttributes(['hidden' => 'hidden']),
            Forms\Components\Hidden::make('horas_ACC')
                ->default(0),
    
            Forms\Components\TextInput::make('type')
            ->label('Status da avaliação')
                ->default('pendente')
                ->disabled()
                ->required(),

            // Dentro da função form()
            Forms\Components\Textarea::make('observacao')
            ->label('Observação Orientador')
            ->readOnly()
            ->maxLength(500), // Limite de caracteres para a observação    
        ]);
    }

    public static function table(Table $table): Table
    {
        $currentUser = Auth::user();

        $query = static::getModel()::query();

       if ($currentUser instanceof User) {
            if (!$currentUser->isSuperAdmin()) {
                if ($currentUser->isAdmin()) {
                    $query->whereHas('user', function ($query) use ($currentUser) {
                        $query->where('id_professor', $currentUser->id);
                    });
                } else {
                    $query->where('id_usuario', $currentUser->id);
                }
            }
        }

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('nome_certificado')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('carga_horaria')
                 ->badge(),
   
                 Tables\Columns\TextColumn::make('type')
                 ->badge()
                 ->color(fn ($state) => match($state) {
                     'Aprovada' => 'success',
                     'Pendente' => 'warning',
                     'Rejeitada' => 'danger',
                     default => null,  // Ou você pode escolher uma cor padrão como 'secondary'
                 })
                 ->tooltip(fn ($state) => $state === 'Rejeitada' ? 'Veja a observação do orientador e Envie de novo o certificado, atendendo o solicitado em caso de ser necesário' : null),
               
                Tables\Columns\TextColumn::make('horas_ACC')->sortable()->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nome do Usuário')
                    ->sortable()
                    ->searchable(),
           
                    Tables\Columns\TextColumn::make('ngAtividade.nome_atividade')
                    ->label('Atividade')
                    ->sortable()
                    ->searchable()
                    ->wrap()
                    ->tooltip(fn ($record) => $record->ngAtividade->nome_atividade)
                    ->formatStateUsing(fn ($state) => \Illuminate\Support\Str::limit($state, 20)),            //   Tables\Columns\TextColumn::make('arquivo')
            //   ->label('Arquivo')
            //   ->url(fn ($record) => asset('storage/certificados/' . $record->arquivo))
            //   ->icon('academicon-dryad-square') // Ícone de download
            //   ->openUrlInNewTab()
            //   ->tooltip('Baixar arquivo'),


                       ])
            ->filters([
                // Defina os filtros, se necessário
            ])
            ->actions([
                !$currentUser->isAdmin()
                    ? Tables\Actions\EditAction::make()
                    : Tables\Actions\Action::make('view')
                        ->label('Ver')
                        ->url(fn ($record) => route('filament.admin.resources.ng-certificados.view', $record))
                        ->icon('heroicon-o-eye'),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                ->label('Baixar')
                ->url(function ($record) {
                    return $record->arquivo ? asset('storage/' . $record->arquivo) : null;
                })
                ->icon('academicon-dryad-square') // Ícone de download
                ->openUrlInNewTab()
                ->tooltip('Baixar arquivo')
                ->visible(fn ($record) => $record->arquivo !== null) // A ação só é visível se houver um arquivo
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
            'view' => Pages\ViewNgCertificados::route('/{record}'),
        ];
    }
}