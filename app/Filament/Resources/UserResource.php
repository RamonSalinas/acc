<?php

namespace App\Filament\Resources;

use App\Exports\BulkExport;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Models\Professor;
use App\Models\AdCursos;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    public static function getModelLabel(): string
    {
        return __('resources.user');
    }

    public static function getPluralLabel(): ?string
    {
        return __('resources.user.plural');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('nome'),
                Infolists\Components\TextEntry::make('email'),
                Infolists\Components\TextEntry::make('email_verified_at'),
                Infolists\Components\IconEntry::make('is_active')->boolean(),
                Infolists\Components\TextEntry::make('roles')
                    ->badge()
                    ->state(function (User $record) {
                        return $record->getRoleNames();
                    })
                    ->columnSpanFull(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->with('roles.permissions', 'permissions')->where('id', '!=', 1);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                            Forms\Components\TextInput::make('cpf')
                            ->required()
                            ->maxLength(11)
                            ->minLength(11)
                            ->unique(User::class, 'cpf', ignoreRecord: true)
                            ->numeric()
                            ->label('CPF')
                            ->helperText('O CPF deve conter apenas números e ter exatamente 11 dígitos.'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->visibleOn('edit'),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(fn (Page $livewire) => ($livewire instanceof Pages\CreateUser))
                            ->maxLength(255)
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->visible(function ($record) {
                                if (!$record) {
                                    return true;
                                }
                                return !$record->isSuperAdmin();
                            }),
                        Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->disabled(function ($record) {
                                if (!$record) {
                                    return false;
                                }
                                return $record->isSuperAdmin();
                            }),
                        Forms\Components\Select::make('roles')
                            ->multiple()
                            ->searchable()
                            ->relationship('roles', 'name', function (Role $role) {
                                return $role::where('id', '!=', 1);
                            })
                            ->preload()
                            ->visible(Auth::user()->hasPermissionTo('role.update')),
                        Forms\Components\Select::make('id_curso')
                            ->label('Curso')
                            ->options(
                                AdCursos::all()->mapWithKeys(fn ($curso) => [
                                    $curso->id => "{$curso->nome_curso} (PPC {$curso->ppc})"
                                ])->toArray()
                            )
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('id_professor')
                            ->label('Professor')
                            ->options(function () {
                                return User::whereColumn('id', 'id_professor')
                                           ->get()
                                           ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload(),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->since()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label("Active")
                    ->boolean(),
                Tables\Columns\TextColumn::make('roles')
                    ->badge()
                    ->state(function (User $record) {
                        return $record->getRoleNames();
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
                Tables\Filters\Filter::make('View Only Active Users')
                    ->query(fn (Builder $query) => $query->where('is_active', true)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('bulk-export')
                        ->label(__('resources.export.bulk'))
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(fn ($records) => new BulkExport($records, 'users.csv'))
                        ->deselectRecordsAfterCompletion()
                ])
            ])
            ->queryStringIdentifier('users')
            ->deferLoading();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }
}
