<?php

namespace App\Filament\Resources\NgCertificadosResource\Pages;

use App\Filament\Resources\NgCertificadosResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action; // Certifique-se de que o namespace está correto
use Illuminate\Support\Facades\Auth; // Para pegar o usuário autenticado
use App\Models\User; // Importa o modelo de usuário
class EditNgCertificados extends EditRecord
{
    protected static string $resource = NgCertificadosResource::class;

    

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Pegue o usuário autenticado
        $user = Auth::user();

        // Verifique se a chave 'id_aluno' existe no array de dados
        if (array_key_exists('id_usuario', $data)) {
            // Acessa o id_aluno no array de dados
            $alunoId = $data['id_usuario'];
            // Encontra o aluno pelo ID
            $aluno = User::find($alunoId);

            if ($aluno) {
                $notification = Notification::make()
                    ->success()
                    ->title('O certificado foi atualizado')
                    ->body('com sucesso pelo seu orientador');

                // Envia a notificação para o aluno
                $aluno->notify($notification->toDatabase());
            } else {
                \Log::error('Aluno não encontrado', ['id_aluno' => $alunoId]);
            }
        } else {
            \Log::error('Chave "id_aluno" não encontrada no array de dados.', ['data' => $data]);
        }

        // Adicione aqui qualquer lógica para modificar os dados antes da edição
        return $data;
    }
}
