<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessorResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ProfessorResource extends Resource
{
    protected static ?string $model = User::class; // Modificado para User

    protected static ?string $navigationIcon = 'academicon-moodle';

    protected static ?string $label = 'Orientandores';
    protected static ?string $navigationLabel = 'Orientandores';
    protected static ?string $pluralLabel = 'Orientandores';

    public static function form(Form $form): Form
    {            
        $nextUserId = User::max('id') + 1;

        return $form
            ->schema([
                Forms\Components\TextInput::make('name') // Modificado para 'name'
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->default(Hash::make('1'))
                    ->readOnly(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Ativo')
                    ->default(true),

                Forms\Components\Select::make('roles')
                    ->multiple()
                    ->searchable()
                    ->relationship('roles', 'name', function (Role $role) {
                        return $role::where('id', '!=', 1);
                    })
                    ->preload()//Retirar de aqui a permisão..
                    ->default([Role::where('name', 'Admin')->first()->id])
                    ->visible(Auth::user()->hasPermissionTo('role.update')),

                Forms\Components\Select::make('id_curso')
                    ->label('Curso')
                    ->options(\App\Models\AdCursos::all()->pluck('nome_curso', 'id'))
                    ->default('1'),
                Forms\Components\Select::make('periodo')
                    ->label('Período')
                    ->options([
                        '2016.1' => '2016.1',
                        '2023.1' => '2023.1',
                    ])
                    ->default('2016.1')
                    ->required(),
                Forms\Components\TextInput::make('id_professor') // Mantendo o ID do usuário
                    ->label('ID Professor')
                    ->default($nextUserId)
                    ->readOnly(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome'), // Modificado para 'name'
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessors::route('/'),
            'create' => Pages\CreateProfessor::route('/create'),
            'edit' => Pages\EditProfessor::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function createRecord($data)
    {
        // Salve os dados na tabela de usuários (users)
        return User::create($data);
    }

    public static function updateRecord($record, $data)
    {
        // Atualize os dados na tabela de usuários (users)
        $record->update($data);
        return $record;
    }
}
