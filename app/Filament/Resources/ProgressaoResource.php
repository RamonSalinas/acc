<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgressaoResource\Pages;
use App\Models\Progressao;
use App\Models\Professor;
use Filament\Forms;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Livewire\Livewire;

class ProgressaoResource extends Resource
{
    protected static ?string $model = Progressao::class;

    protected static ?string $navigationIcon = 'academicon-philpapers-square';
    protected static ?string $navigationGroup = 'Gerenciamento de Progressão';
    protected static ?string $label = 'Progressão +';

    public static function gerarNomeProgressaoPadrao()
    {
        $ultimoId = Progressao::max('id') + 1;
        $dataAtual = Carbon::now();
        $dataFormatada = $dataAtual->format('d-m-Y');
        return "Progressao-{$ultimoId}-{$dataFormatada}";
    }

    public static function form(Form $form): Form
    {
        /** @var User $user */
      $user = Auth::user();

        // Verifique se o usuário tem um objeto professor
        if (!$user->professoreshasMany()->exists()) {
            // Crie um novo objeto professor com valores padrão
            $user->professoreshasMany()->create([
                'user_id' => $user->id, // Certifique-se de que o campo user_id está sendo preenchido
                'email' => $user->email,
                'siape' => '0000000',
                'lotacao' => '',
                'admissao' => Carbon::now(),
                'classe' => 'A',
                'regime' => 'DE',
                'nivel' => '1',
                'data_ultima_progressao' => Carbon::now(),
                'intersticio_data_inicial' => Carbon::now(),
                'intersticio_data_final' => Carbon::now()->addYear(),
            ]);


        }
      //  dd('entrou EXISTE');    

        // Carregue os dados do professor
        $professor = $user->professoreshasMany()->first();

        // Adiciona o ID do professor aos dados
        $data['professor_id'] = $professor ? $professor->id : null;

        return $form
            ->schema([
                TextInput::make('nome_progressao')
                    ->label('Nome da Progressão')
                    ->disabled()
                    ->default(self::gerarNomeProgressaoPadrao()),

                TextInput::make('siape')
                    ->label('SIAPE')
                    ->default($professor ? $professor->siape : ''),

                Select::make('lotacao')
                    ->label('Lotação')
                    ->options([
                        'CCET' => 'CCET',
                        'CBSB' => 'CBSB',
                        'CMMD' => 'CMMD',
                    ])
                    ->default($professor ? $professor->lotacao : ''),

                DatePicker::make('admissao')
                    ->label('Admissão')
                    ->default($professor ? $professor->admissao : null),

                Select::make('classe')
                    ->label('Classe')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                        'E' => 'E',
                    ])
                    ->default($professor ? $professor->classe : ''),

                Select::make('nivel')
                    ->label('Nível')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ])
                    ->default($professor ? $professor->nivel : ''),

                DatePicker::make('data_ultima_progressao')
                    ->label('Data Última Progressão')
                    ->default($professor ? $professor->data_ultima_progressao : null),

                Select::make('regime')
                    ->label('Regime')
                    ->options([
                        'DE' => 'DE',
                        '20h' => '20h',
                        '40h' => '40h',
                    ])
                    ->default($professor ? $professor->regime : ''),

                DatePicker::make('intersticio_data_inicial')
                    ->label('Interstício Data Inicial')
                    ->default($professor ? $professor->intersticio_data_inicial : null),

                DatePicker::make('intersticio_data_final')
                    ->label('Interstício Data Final')
                    ->default($professor ? $professor->intersticio_data_final : null),

                TextInput::make('professor_id')
                    ->label('Professor ID')
                    ->default($professor ? $professor->id : ''),
                   // ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome_progressao')
                    ->label('Nome da Progressão'),
                Tables\Columns\TextColumn::make('intersticio_data_inicial')
                    ->label('Interstício Data Inicial')
                    ->date(),
                Tables\Columns\TextColumn::make('intersticio_data_final')
                    ->label('Interstício Data Final')
                    ->date(),
                Tables\Columns\TextColumn::make('professor.siape')
                    ->label('SIAPE'),
                Tables\Columns\TextColumn::make('professor.lotacao')
                    ->label('Lotação'),
                Tables\Columns\TextColumn::make('professor.admissao')
                    ->label('Admissão')
                    ->date(),
                Tables\Columns\TextColumn::make('professor.classe')
                    ->label('Classe'),
                Tables\Columns\TextColumn::make('professor.regime')
                    ->label('Regime'),
                Tables\Columns\TextColumn::make('professor.nivel')
                    ->label('Nível'),
                Tables\Columns\TextColumn::make('professor.data_ultima_progressao')
                    ->label('Data Última Progressão')
                    ->date(),
            ])
            ->filters([
                // Adicione filtros aqui, se necessário
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Nova Progressão'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Defina suas relações aqui
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProgressaos::route('/'),
            'create' => Pages\CreateProgressao::route('/create'),
            'edit' => Pages\EditProgressao::route('/{record}/edit'),
        ];
    }
}