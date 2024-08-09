<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NgCertificadosProgressaoResource\Pages;
use App\Filament\Resources\NgCertificadosProgressaoResource\RelationManagers;
use App\Models\NgCertificadosProgressao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use App\Models\NgAtividadesProgressao;
use App\Models\AdGrupoProgressao;
use Filament\Notifications\Notification;
use Carbon\Carbon;
use Filament\Forms\Set;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\Models\AdCursos;
use App\Models\Progressao;
use App\Models\Professor;

class NgCertificadosProgressaoResource extends Resource
{
    protected static ?string $model = NgCertificadosProgressao::class;
    protected static ?string $navigationIcon = 'academicon-dataverse';
    protected static ?string $navigationGroup = 'Gerenciamento de Progressão';
    protected static ?string $label = 'Certificados Progressão';


    public static function form(Form $form): Form
    { 
        
        //dd($professorId);

        return $form->schema([

            Select::make('progressao_id')
    ->label('Nome da Progressão')
    ->options(function () {
        $user = Auth::user();
        $currentUser = Auth::user();
        $professor = Professor::where('user_id', $currentUser->id)->first();
        $professorId = $professor ? $professor->id : null;

        $options = Progressao::where('professor_id', $professorId)
        ->pluck('nome_progressao', 'id')
        ->toArray();
//$options = Progressao::pluck('nome_progressao', 'id')->toArray();


     //  $options = Progressao::pluck('nome_progressao', 'id')->toArray();
        

      // $options = $user->progressoes()->pluck('nome_progressao', 'id')->toArray();
        if (empty($options)) {
            Notification::make()
                ->title('Aviso')
                ->body('Primeiro precisa registrar uma nova progressão para registrar atividades')
                ->warning()
                ->send();
        }
        return $options;
    })
    ->default(function () {
        $currentUser = Auth::user();
        $professor = Professor::where('user_id', $currentUser->id)->first();
        $professorId = $professor ? $professor->id : null;

        $lastProgressao = Progressao::where('professor_id', $professorId)->latest()->first();
        return $lastProgressao ? $lastProgressao->id : null;
    })
    ->required()
    ->reactive()
    ->searchable()
    ->getSearchResultsUsing(function (string $search): array {
        $results = Progressao::where('nome_progressao', 'like', "%{$search}%")->limit(50)->get();
        return $results->pluck('nome_progressao', 'id')->toArray();
    })
    ->getOptionLabelUsing(fn ($value): ?string => Progressao::find($value)?->nome),
        





           Select::make('ad_grupo_progressao_id')
            ->label('Grupo de Atividades')
            ->options(function () {
                return AdGrupoProgressao::pluck('nome_grupo_progressao', 'id')->toArray();
            })
            ->required()
            ->reactive()
            ->searchable()
            ->getSearchResultsUsing(function (string $search): array {
                $results = AdGrupoProgressao::where('nome_grupo_progressao', 'like', "%{$search}%")->limit(50)->get();
                return $results->pluck('nome_grupo_progressao', 'id')->toArray();
            })
            ->getOptionLabelUsing(fn ($value): ?string => AdGrupoProgressao::find($value)?->nome_grupo_progressao)
            ->afterStateUpdated(function (callable $set) {
                // Aqui você pode resetar os valores dos campos dependentes, se necessário.
            }),

           Select::make('ng_atividades_progressao_id')
                ->label('Nome da Atividade de Progressão')
                ->required()
                ->reactive()
                ->options(function (callable $get) {
                    $grupoAtividadesId = $get('ad_grupo_progressao_id');
                    if ($grupoAtividadesId) {
                        return NgAtividadesProgressao::where('ad_grupo_progressao_id', $grupoAtividadesId)
                            ->pluck('nome_da_atividade', 'id')
                            ->toArray();
                    }
                    return [];
                })
                ->afterStateUpdated(function (callable $set, callable $get, $state) {
                   // $set('horas_ACC', null);
                    //$set('carga_horaria', null);
                    
    
                    if ($state) {
                        $atividade = NgAtividadesProgressao::find($state);
                        if ($atividade) {
                            $set('referencia', $atividade->referencia);
                           // $set('percentual_maximo', $atividade->percentual_maximo);
    
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


                Forms\Components\TextInput::make('referencia') // This hidden field ensures the value is sent to the database
                ->label('Referência')
                ->default(0)
                ->disabled()
                ->extraAttributes(['hidden' => 'hidden']),
                
            Forms\Components\Hidden::make('referencia')
                ->default(0),

                
            TextInput::make('quantidade')
                ->label('Quantidade')
                ->numeric()
                ->required()
                ->rule('min:1') // Garante que o valor seja maior que 0
                ->reactive() // Torna este campo reativo
                ->afterStateUpdated(function (callable $set, callable $get, $state) {

//                ->afterStateUpdated(function (callable $set, callable $get) {
                    // Obtém os valores necessários para o cálculo
                    $idTipoAtividade = $get('ad_grupo_progressao_id');
                    $valorUnitario = $get('referencia');
                    $quantidade = $get('quantidade');

                    // Realiza o cálculo. Ajuste conforme a lógica necessária.
                    $pontuacao = $valorUnitario * $idTipoAtividade * $quantidade;
                    $set('pontuacao', $pontuacao);

                    // Verifica se o curso do usuário está definido
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
                }),
            TextInput::make('pontuacao')
                ->label('Pontuação')
                ->default(0)
                ->disabled()
                ->extraAttributes(['hidden' => 'hidden']),
                Forms\Components\Hidden::make('pontuacao')
                ->default(0),
                  
            FileUpload::make('arquivo_progressao')
                ->label('Arquivo de Progressão')
                //->required()
                ->acceptedFileTypes(['image/*', 'application/pdf']),
            
                DatePicker::make('data_inicial')
                ->label('Data Inicial')
                ->required()
                ->reactive()
                ->default(Carbon::now())
                ->afterStateUpdated(function (callable $set, $state, $get) {
                    // Limpa a duração se a data inicial for alterada
                    $set('duracao', null);
            
                    // Obtenha o ID da progressão selecionada
                    $progressaoId = $get('progressao_id');
            
                    if ($progressaoId) {
                        // Obtenha a progressão correspondente
                        $progressao = Progressao::find($progressaoId);
            
                        if ($progressao) {
                            // Compare as datas
                            $intersticioDataInicial = Carbon::parse($progressao->intersticio_data_inicial);
                            $dataInicial = Carbon::parse($state);
            
                            if ($dataInicial->lt($intersticioDataInicial)) {
                                Notification::make()
                                    ->title('Aviso')
                                    ->body('A data do certificado anexar é menor que a data do interstício e poderia não ser considerada o tempo anterior pelo avaliador.')
                                    ->warning()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Sucesso')
                                    ->body('Certificado no período adequado.')
                                    ->success()
                                    ->send();
                            }
                        }
                    }
                }),
            
            DatePicker::make('data_final')
                ->label('Data Final')
                ->required()
                ->reactive()
                ->default(Carbon::now())

                ->afterStateUpdated(function (callable $set, callable $get, $state) {
                    $dataInicial = $get('data_inicial');
                    if (!$state || !$dataInicial) {
                        return;
                    }

                    $dataInicial = Carbon::createFromFormat('Y-m-d', $dataInicial);
                    $dataFinal = Carbon::createFromFormat('Y-m-d', $state);

                    if ($dataFinal->lt($dataInicial)) {
                        $set('data_final', $dataInicial->addDay()->format('Y-m-d'));
                        Notification::make()
                            ->title('Erro')
                            ->body('A Data Final deve ser posterior à Data Inicial.')
                            ->danger()
                            ->send();
                        return;
                    }

                    $diferenca = $dataInicial->diff($dataFinal);
                    $duracao = "{$diferenca->m} mês(es) e {$diferenca->d} dia(s)";
                    $set('duracao', $duracao);
                }),

            TextInput::make('duracao')
                ->label('Duração da Atividade Registrada')
                ->disabled()
                ->dehydrated(false)
                ->visible(fn ($get) => $get('duracao') !== null),
            Textarea::make('observacao')
            ->default('XXXXXX')

                ->label('Observação'),
           
           
                Forms\Components\TextInput::make('status') // This hidden field ensures the value is sent to the database
                ->label('Status')
                ->default('Pendente')
                ->disabled()
                ->extraAttributes(['hidden' => 'hidden']),
                
            Forms\Components\Hidden::make('status')
                ->default(0),
           
           
                 TextInput::make('id_usuario')
                ->label('ID do Usuário')
                ->default(auth()->id())
                ->disabled()
                ->extraAttributes(['hidden' => 'hidden']),

        ]);
    }

    public static function table(Table $table): Table
    {
        $currentUser = Auth::user();

        $query = static::getModel()::query();

        if ($currentUser instanceof User) {
            if (!$currentUser->isSuperAdmin()) {
               
                if ($currentUser->isAdmin()) {
                    //dd('somos admin');

                    $query->where('id_usuario', $currentUser->id);

//                    $query->whereHas('usuario', function ($query) use ($currentUser) {
    //                    $query->where('id_professor', $currentUser->id);
  //                  });
                } else {
                    $query->where('id_usuario', $currentUser->id);
                }
            }
        }

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('ad_grupo_progressao_id')
                    ->label('Grupo Progressão'),
                Tables\Columns\TextColumn::make('ng_atividades_progressao_id')
                    ->label('Atividade Progressão'),
                Tables\Columns\TextColumn::make('referencia')
                    ->label('Referência'),
                Tables\Columns\TextColumn::make('quantidade')
                    ->label('Quantidade'),
                Tables\Columns\TextColumn::make('pontuacao')
                    ->label('Pontuação'),
                Tables\Columns\TextColumn::make('data_inicial')
                    ->label('Data Inicial')
                    ->date(),
                Tables\Columns\TextColumn::make('data_final')
                    ->label('Data Final')
                    ->date(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),
                Tables\Columns\TextColumn::make('usuario.name')
                    ->label('Usuário'),
                Tables\Columns\TextColumn::make('pontuacao_avaliador')
                    ->label('Pontuação Avaliador'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNgCertificadosProgressao::route('/'),
            'create' => Pages\CreateNgCertificadosProgressao::route('/create'),
            'edit' => Pages\EditNgCertificadosProgressao::route('/{record}/edit'),
        ];
    }
}
