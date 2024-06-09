<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        if ($this->record->isSuperAdmin()) {
            return [];
        }
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        // Runs before the form fields are saved to the database.
        // Esta parte está correta, mas desnecessária se a notificação será enviada no método getSavedNotification.
    }

    protected function getSavedNotification(): ?Notification
{
    // Criação da notificação
    $notification = Notification::make()
        ->success()
        ->title('User updated')
        ->body('The user has been saved successfully.');

    // Enviar a notificação para o banco de dados
    $user = \auth()->user();
    
    try {
        $user->notify($notification->toDatabase());
        \Log::info('Notificação enviada com sucesso');
    } catch (\Exception $e) {
        \Log::error('Erro ao enviar notificação', ['exception' => $e]);
    }

    return $notification;
}
}
