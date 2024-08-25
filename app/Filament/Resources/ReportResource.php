<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\NgCertificados;
use App\Models\User;
use App\Models\AdCursos;
use Illuminate\Support\Facades\Auth;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\BulkAction;
use Filament\Notifications\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\BulkExport;

class ReportResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Orientaçãoes Academicas';

    protected static ?string $navigationIcon = 'academicon-open-data';
    protected static ?string $navigationLabel = 'Reportes';
    protected static ?string $pluralLabel = 'Reportes';

    public static function table(Table $table): Table
    {
        /**@var  */
 /** @var User $currentUser */

        $currentUser = Auth::user();

        // Obter IDs dos usuários que possuem certificados
        $userIdsWithCertificates = NgCertificados::query()
            ->where(function ($query) use ($currentUser) {
                // Se não for SuperAdmin, incluir condição baseada no perfil
                if (!$currentUser->isSuperAdmin()) {
                    if ($currentUser->isAdmin() || $currentUser->isEspecialista()|| $currentUser->isAvaliador()) {
                        $query->whereHas('user', function ($query) use ($currentUser) {
                            $query->where('id_professor', $currentUser->id);
                        });
                    } else {
                        $query->where('id_usuario', $currentUser->id);
                    }
                }
            })
            ->pluck('id_usuario')
            ->unique();

        // Consultar o modelo User com os IDs obtidos
        $query = User::query()
            ->whereIn('id', $userIdsWithCertificates)
            ->with(['certificados' => function ($query) {
                $query->select('id_usuario', 'type');
            }]);

            return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Usuário')
                    ->sortable()
                    ->searchable()
                    ->url(fn ($record) => route('pdf_generatePdfuser', ['id' => $record->id])),
                    Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable()
                    ->url(fn ($record) => route('pdf_generatePdfuser', ['id' => $record->id])),
                Tables\Columns\TextColumn::make('id_curso')
                    ->label('Curso')
                    ->sortable()
                    ->getStateUsing(function ($record) {
                        return AdCursos::find($record->id_curso)->nome_curso ?? 'N/A';
                    })
                    ->url(fn ($record) => route('pdf_generatePdfuser', ['id' => $record->id])),
                    Tables\Columns\TextColumn::make('type')
                    ->label('Status do Certificado')
                    ->getStateUsing(function ($record) {
                        $statuses = $record->certificados->pluck('type');
                        if ($statuses->every(fn ($type) => $type === 'Aprovada')) {
                            return 'Aprovada';
                        }
                        return 'Pendente';
                    })
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'Aprovada' => 'success',
                        'Pendente' => 'warning',
                        'Rejeitada' => 'danger',
                        default => null,
                    })
                    ->url(fn ($record) => route('pdf_generatePdfuser', ['id' => $record->id])),
            ])
            ->filters([
                // Defina os filtros, se necessário
            ])
            ->actions([
                !($currentUser->isAdmin() || $currentUser->isAvaliador())
                                    ? Tables\Actions\EditAction::make()
                    : Tables\Actions\Action::make('generatePdf')
                        ->label('Gerar PDF')
                        ->url(fn ($record) => route('pdf_generatePdfuser', ['id' => $record->id]))
                        ->icon('heroicon-o-document')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('bulk-export')
                        ->label(__('resources.export.bulk'))
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(fn ($records) => new BulkExport($records, 'users_with_certificados.csv'))
                        ->deselectRecordsAfterCompletion()
                ])
            ])
            ->queryStringIdentifier('users_with_certificados')
            ->deferLoading();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
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
                return true;
            }
    
            // Verifica se o usuário atual é um Avaliador
           if ($user->isAvaliador()) {
              // Se for um Avaliador, retorna true para permitir ver todos os registros
               return true;
           }
  // Verifica se o usuário atual é um Alumnos
            if ($user->isEspecialista()) {
                // Se for um Avaliador, retorna true para permitir ver todos os registros
                return true;
            }



        }
    
        // Se não for nenhum dos casos acima, retorna false por padrão
        return false;
    }



}
