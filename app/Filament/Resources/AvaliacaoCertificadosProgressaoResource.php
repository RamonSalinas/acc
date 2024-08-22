<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AvaliacaoCertificadosProgressaoResource\Pages;
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

use function Pest\Laravel\disableCookieEncryption;

class AvaliacaoCertificadosProgressaoResource extends Resource
{
    protected static ?string $model = NgCertificadosProgressao::class;
    protected static ?string $navigationIcon = 'academicon-dataverse';
    protected static ?string $navigationGroup = 'Avaliação de Progressão';
    protected static ?string $label = 'Avaliação Certificados Progressão';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('progressao_id')
            ->label('Nome da Progressão')
            ->default(function () {
                $currentUser = Auth::user();
                $professor = Professor::where('user_id', $currentUser->id)->first();
                $professorId = $professor ? $professor->id : null;
                $lastProgressao = Progressao::where('professor_id', $professorId)->latest()->first();
                return $lastProgressao ? $lastProgressao->nome_progressao : null; // Retorna o nome da progressão
            })
            ->required()
            ->disabled() // Impede que o campo seja modificado
            ->afterStateHydrated(function ($state, $set, $get) {
                Notification::make()
                ->title('Por favor, atualize o status do certificado e defina o valor aprovado')
                ->body('Apreciado avaliador, solicitamos que atualize o status do certificado, defina o valor que considerar apropriado no formulário anexado, e adicione sua observação. Após isso, não se esqueça de salvar as alterações.')
                    ->info()
                    ->send();
            }),

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
                    if ($state) {
                        $atividade = NgAtividadesProgressao::find($state);
                        if ($atividade) {
                            $set('referencia', $atividade->referencia);

                            if (in_array($state, [7, 9, 15, 80, 82, 83, 13, 14, 15, 16, 17, 18, 19, 20, 21, 23, 25, 26, 27, 28, 29, 32, 33, 34, 35, 36, 37, 39, 40, 41, 43, 44, 45, 50, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74])) {
                                Notification::make()
                                    ->title('Atividade Especial Selecionada')
                                    ->body('Você selecionou uma atividade especial. Agregue o número de atividades realizadas.')
                                    ->success()
                                    ->send();
                            }
                        }
                    }
                }),

            TextInput::make('referencia')
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
                ->rule('min:1')
                ->disabled()
                ->reactive()
                ->afterStateUpdated(function (callable $set, callable $get, $state) {
                    $idTipoAtividade = $get('ad_grupo_progressao_id');
                    $valorUnitario = $get('referencia');
                    $quantidade = $get('quantidade');

                    $pontuacao = $valorUnitario * $idTipoAtividade * $quantidade;
                    $set('pontuacao', $pontuacao);

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
                ->disabled()
                ->acceptedFileTypes(['image/*', 'application/pdf']),

            DatePicker::make('data_inicial')
                ->label('Data Inicial')
                ->required()
                ->reactive()
                ->disabled()
                ->default(Carbon::now())
                ->afterStateUpdated(function (callable $set, $state, $get) {
                    $set('duracao', null);

                    $progressaoId = $get('progressao_id');

                    if ($progressaoId) {
                        $progressao = Progressao::find($progressaoId);

                        if ($progressao) {
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
                ->disabled()
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
                ->disabled()
                ->label('Observação'),

                Select::make('status')
                ->label('Status')
                ->options([
                    'Pendente' => 'Pendente',
                    'Aprovado' => 'Aprovado',
                    'Rejeitada' => 'Rejeitada',
                ])
                ->default('Pendente')
                ->extraAttributes(['class' => 'text-red-500 border-2 border-red-500 p-2 rounded']),
                
                TextInput::make('quantidade_avaliador')
                ->label('Quantidade Avaliador')
                ->numeric()
                ->required()
                ->rule('min:1')
                ->reactive()
                ->afterStateUpdated(function (callable $set, callable $get, $state) {
                    $idTipoAtividade = $get('ad_grupo_progressao_id');
                    $valorUnitario = $get('referencia');
                    $quantidade = $get('quantidade_avaliador');

                    $pontuacao = $valorUnitario * $idTipoAtividade * $quantidade;
                    $set('pontuacao_avaliador', $pontuacao);

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

            TextInput::make('pontuacao_avaliador')
                ->label('Pontuação Avaliador')
                ->default(0)
                ->disabled()
                ->extraAttributes(['hidden' => 'hidden']),

            Forms\Components\Hidden::make('pontuacao_avaliador')
                ->default(0),
            
            Textarea::make('observacao_avaliador')
                ->label('Observação do Avaliador')
                ->required(),

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
//dd($userIds);
            
//            $certificados = NgCertificadosProgressao::whereIn('id_usuario', $userIds)->get();

           //dd($certificados);

                $query->whereIn('id_usuario', $userIds);

                
            } else {
                      dd('entro no else porque?');
            }
            }
            }

            return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('grupoProgressao.nome_grupo_progressao')
                    ->label('Grupo Progressão')
                    ->alignCenter(),
                /* Tables\Columns\TextColumn::make('data_inicial')
                    ->label('Data Inicial')
                    ->date()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('data_final')
                    ->label('Data Final')
                    ->date()
                    ->alignCenter(),*/
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'Aprovada' => 'success',
                        'Pendente' => 'warning',
                        'Rejeitada' => 'danger',
                        default => null,  // Ou você pode escolher uma cor padrão como 'secondary'
                    })
                    ->tooltip(fn ($state) => $state === 'Rejeitada' ? 'Veja a observação registrada' : null)
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('usuario.name')
                    ->label('Usuário')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('pontuacao')
                    ->label('Pontuação Registrada')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('pontuacao_avaliador')
                    ->label('Pontuação Avaliada')
                    ->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Baixar')
                    ->url(function ($record) {
                        return $record->arquivo_progressao ? asset('storage/' .$record->arquivo_progressao) : null;
                    })
                    ->icon('academicon-dryad-square') // Ícone de download
                    ->openUrlInNewTab()
                    ->tooltip('Baixar arquivo')
                    ->visible(fn ($record) => $record->arquivo_progressao !== null) // A ação só é visível se houver um arquivo
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
            'index' => Pages\ListAvaliacaoCertificadosProgressaos::route('/'),
            'create' => Pages\CreateAvaliacaoCertificadosProgressao::route('/create'),
            'edit' => Pages\EditAvaliacaoCertificadosProgressao::route('/{record}/edit'),
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