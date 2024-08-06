<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NgAtividadesProgressaoResource\Pages;
use App\Filament\Resources\NgAtividadesProgressaoResource\RelationManagers;
use App\Models\NgAtividadesProgressao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NgAtividadesProgressaoResource extends Resource
{
    protected static ?string $model = NgAtividadesProgressao::class;

    protected static ?string $navigationIcon = 'academicon-ads-square';
    protected static ?string $navigationGroup = 'Gerenciamento de Progressão';
    protected static ?string $label = 'Atividades Progressão';



    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('ad_grupo_progressao_id')
                ->label('Grupo de Progressão')
                ->relationship('adGrupoProgressao', 'nome_grupo_progressao') // Certifique-se de que o método relationship está correto
                ->required(),
          
            Forms\Components\TextInput::make('nome_da_atividade')
                ->label('Nome da Atividade de Progressão')
                ->required(),
          
            Forms\Components\TextInput::make('referencia')
                ->label('Referência')
                ->numeric()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table 
        
        ->columns([
          //  Tables\Columns\TextColumn::make('adGrupoProgressao.nome_grupo_progressao')
          Tables\Columns\TextColumn::make('adGrupoProgressao.id')
                ->label('Grupo'),
            Tables\Columns\TextColumn::make('nome_da_atividade')
                ->label('Nome da Atividade de Progressão'),
            Tables\Columns\TextColumn::make('referencia')
                ->label('Referência'),
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
            'index' => Pages\ListNgAtividadesProgressaos::route('/'),
            'create' => Pages\CreateNgAtividadesProgressao::route('/create'),
            'edit' => Pages\EditNgAtividadesProgressao::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {        /** @var User $user */

        $user = auth()->user();
        return $user && $user->hasRole(['Super-Admin']);
    }


}
