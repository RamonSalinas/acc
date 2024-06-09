<?php

namespace App\Observers;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action; // Certifique-se de que o namespace está correto
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
{
    $notification = Notification::make()
        ->success()
        ->title('Bem-vindo ao sistema de registro de ACC da UFOB')
        ->body('Não se esqueça de atualizar seu curso e semestre para poder registrar suas atividades complementares.')
        ->actions([
            Action::make('Atualizar dados')
                ->button()
                ->url(route('filament.admin.pages.settings')), // Gerando a URL corretamente
        ]);

    $user->notify($notification->toDatabase()); // Notificando o usuário
}


    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user)
    {
        // Enviar notificação quando um usuário for atualizado
        $notification = Notification::make()
            ->success()
            ->title('User updated Observer')
            ->body('The user has been updated successfully. >)');

        $user->notify($notification->toDatabase());
    }
    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
