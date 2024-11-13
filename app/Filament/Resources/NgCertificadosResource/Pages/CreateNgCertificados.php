<?php

namespace App\Filament\Resources\NgCertificadosResource\Pages;

use App\Filament\Resources\NgCertificadosResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification as FilamentNotification; // Importação correta
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class CreateNgCertificados extends CreateRecord
{
    protected static string $resource = NgCertificadosResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $recipient = Auth::user();
        \Log::info('Enviando notificação para o usuário', ['user' => Auth::user()]);

        $notification = FilamentNotification::make()
            ->title('Certificado registrado para aprovação')
            ->icon('heroicon-o-document-text')
            ->iconColor('success')
            ->body("O certificado " . $data['nome_certificado'] . " foi registrado com sucesso e está aguardando aprovação.")
            ->color('success')
            ->send();

        try {
            //$recipient->notify($notification); // Enviando a notificação diretamente
        Notification::make()
        ->title('Certificado registrado para aprovação')
        ->sendToDatabase($recipient);
            \Log::info('Notificação enviada com sucesso');
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar notificação', ['exception' => $e]);
        }

        return $data;
    }
}
