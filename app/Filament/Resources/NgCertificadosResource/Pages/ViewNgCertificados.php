<?php

namespace App\Filament\Resources\NgCertificadosResource\Pages;

use App\Filament\Resources\NgCertificadosResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Filament\Facades\Filament;
use Filament\Forms;

class ViewNgCertificados extends ViewRecord
{
    protected static string $resource = NgCertificadosResource::class;

    public $observacao; // Adiciona a propriedade observacao

    protected function getActions(): array
    {
        return [
            Action::make('Aprovar')
                ->label('Aprovar')
                ->action(function () {
                    $this->record->update([
                        'type' => 'Aprovada',
                    ]);
                    
                    Log::info('Ação Aprovar iniciada', ['record_id' => $this->record->id, 'user_id' => $this->record->id_usuario]);
                    $this->notifyAluno($this->record->id_usuario, 'Certificado Aprovado', 'O certificado foi aprovado pelo seu orientador.');
                    
                    Notification::make()
                        ->title('Certificado Aprovado')
                        ->success()
                        ->send();
                    
                    // Redirecionar para a página da lista de certificados
                    return redirect()->route('filament.admin.resources.ng-certificados.index');
                })
                ->color('success')
                ->icon('phosphor-certificate-duotone')
                ->visible(fn() => Auth::user()->isAdmin()), // Visível apenas para administradores


            Action::make('Rejeitar')
                ->label('Rejeitar')
                ->form([
                    Forms\Components\Textarea::make('observacao')
                        ->label('Observação')
                        ->maxLength(500)
                        ->required(), // Torna o campo obrigatório
                        
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'type' => 'Rejeitada',
                        'observacao' => $data['observacao'], // Salva a observação no modelo
                    ]);
                    
                    Log::info('Ação Rejeitar iniciada', ['record_id' => $this->record->id, 'user_id' => $this->record->id_usuario, 'observacao' => $data['observacao']]);
                    $this->notifyAluno($this->record->id_usuario, 'Certificado Rejeitado', 'O certificado foi rejeitado pelo seu orientador.');
                    
                    Notification::make()
                        ->title('Certificado Rejeitado')
                        ->danger()
                        ->send();
                    
                    // Redirecionar para a página da lista de certificados
                    return redirect()->route('filament.admin.resources.ng-certificados.index');
                })
                ->color('danger')
                ->icon('phosphor-certificate-duotone')
                ->visible(fn() => Auth::user()->isAdmin()), // Visível apenas para administradores

            
            Action::make('Baixar')
                ->label('Baixar Arquivo')
                ->url(fn() => $this->record->arquivo ? asset('storage/' . $this->record->arquivo) : null)
                ->icon('phosphor-certificate-duotone')
                ->openUrlInNewTab()
                ->visible(fn() => $this->record->arquivo !== null),
        ];
    }

    protected function notifyAluno($alunoId, $title, $body)
    {
        Log::info('Notificação ao aluno iniciada', ['id_aluno' => $alunoId]);
        
        $aluno = User::find($alunoId);
        if ($aluno) {
            Log::info('Aluno encontrado', ['id_aluno' => $alunoId, 'aluno' => $aluno->toArray()]);
            
            $notification = Notification::make()
                ->title($title)
                ->body($body)
                ->success();
                
            $aluno->notify($notification->toDatabase());
            
            Log::info('Notificação enviada ao aluno', ['id_aluno' => $alunoId]);
        } else {
            Log::error('Aluno não encontrado', ['id_aluno' => $alunoId]);
        }
    }
}
