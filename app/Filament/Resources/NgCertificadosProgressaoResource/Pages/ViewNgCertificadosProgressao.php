<?php
namespace App\Filament\Resources\NgCertificadosProgressaoResource\Pages;

use App\Filament\Resources\NgCertificadosProgressaoResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use App\Models\Professor;
use App\Models\Progressao;
use Filament\Notifications\Notification;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Log;

class ViewNgCertificadosProgressao extends ViewRecord
{
    protected static string $resource = NgCertificadosProgressaoResource::class;

    protected function getActions(): array
    {
        return [
                Action::make('Baixar')
                ->label('Baixar Arquivo')
                ->url(fn() => $this->record->arquivo_progressao ? asset('storage/' . $this->record->arquivo_progressao) : null)
                ->icon('phosphor-certificate-duotone')
                ->openUrlInNewTab()
                ->visible(fn() => $this->record->arquivo_progressao !== null),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('progressao_id')
                ->label('Nome da Progressão')
                ->options(function () {
                    $currentUser = Auth::user();
                    $professor = Professor::where('user_id', $currentUser->id)->first();
                    $professorId = $professor ? $professor->id : null;

                    $options = Progressao::where('professor_id', $professorId)
                        ->pluck('nome_progressao', 'id')
                        ->toArray();

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
                ->getOptionLabelUsing(fn ($value): ?string => Progressao::find($value)?->nome)
                ->disabled(fn ($livewire) => $livewire instanceof self),

            // Repita o mesmo para os outros campos...
        ];
    }
}