<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\AdCursos;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.pages.settings';
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Configuração';
    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('pages.profile.settings');
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getForms(): array
    {
        return [
            'updateSystemSettingsForm',
            'updateProfileFrom',
            'updatePasswordForm',
        ];
    }

    public $name;
    public $email;
    public $cpf;
    public $id_curso;
    public $id_professor;
    public $roles;
    public $userId;

    public $language;

    public function mount(): void
{
    $user = Auth::user();

    if ($user) {
        //$roles = optional($user->roles)->pluck('id')->toArray();

   

        $this->updateProfileFrom->fill([
            'name' => $user->name,
            'email' => $user->email,
            'cpf' => $user->cpf,
            'id_curso' => $user->id_curso,
            'id_professor' => $user->id_professor,
        //   'roles' => $roles,
        ]);

        $this->userId = $user->id;
    }

    $this->language = session('locale', config('app.locale'));
}





    public function saveProfileAction()
    {
        return Action::make('save profile information')
            ->label(__('pages.profile.action.label'))
            ->action('saveProfile')
            ->color('primary');
    }

    public function savePasswordAction()
    {
        return Action::make('update password')
            ->label(__('pages.profile.action.password.label'))
            ->action('updatePassword')
            ->color('primary');
    }

    public function saveSettingsAction()
    {
        return Action::make('update system settings')
            ->label(__('pages.system.action.label'))
            ->action('updateSettings')
            ->color('primary');
    }

    public function saveProfile(): void
    {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId . ',id',
            'cpf' => 'max:255',
            'id_curso' => 'required|exists:ad_cursos,id',
            'id_professor' => 'required|exists:users,id',
//'roles' => 'required|array',
      //      'roles.*' => 'exists:roles,id',
        ]);

        try {
            $user = Auth::user();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->cpf = $this->cpf;
            $user->id_curso = $this->id_curso;
            $user->id_professor = $this->id_professor;
            //$user->syncRoles($this->roles);
            $user->save();

            Notification::make()
                ->title(__('notifications.save.success'))
                ->success()
                ->send();
        } catch (\Throwable $th) {
            Notification::make()
                ->title(__('notifications.profile.save.failed'))
                ->danger()
                ->send();
        }
    }

    public function updatePassword(): void
    {
        $this->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required_with:password|min:6',
        ]);

        try {
            $user = Auth::user();
            $user->password = Hash::make($this->password);
            $user->save();

            Notification::make()
                ->title(__('notifications.profile.password.save.success'))
                ->success()
                ->send()
                ->sendToDatabase(Auth::user());
        } catch (\Throwable $th) {
            Notification::make()
                ->title(__('notifications.profile.save.failed'))
                ->danger()
                ->send();
        }
    }

    public function updateSettings()
    {
        $this->validate([
            'language' => 'required|string',
        ]);

        try {
            session()->put('locale', $this->language);
            app()->setLocale($this->language);
            Carbon::setLocale($this->language);

            Notification::make()
                ->title(__('notifications.save.success'))
                ->success()
                ->send()
                ->sendToDatabase(Auth::user());

            return redirect('/admin');
        } catch (\Throwable $th) {
            Notification::make()
                ->title(__('notifications.profile.save.failed'))
                ->danger()
                ->send();
        }
    }

    public function updatePasswordForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('pages.profile.password'))
                    ->description(__('pages.profile.update_password'))
                    ->schema([
                        TextInput::make('password')
                            ->label(__('pages.profile.form.label.password'))
                            ->password()
                            ->autocomplete(false),
                        TextInput::make('password_confirmation')
                            ->label(__('pages.profile.form.label.password_confirmed'))
                            ->password(),
                    ])->columns(2),
            ]);
    }

    public function updateProfileFrom(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('pages.profile.account_information'))
                    ->description(__('pages.profile.account_settings'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('pages.profile.form.label.name'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('cpf')
                            ->label(__('CPF'))
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label(__('pages.profile.form.label.email'))
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        DateTimePicker::make('email_verified_at')
                            ->label(__('Email Verified At'))
                            ->visibleOn('edit'),
                      /*  Select::make('roles')
                            ->label(__('Roles'))
                            ->multiple()
                            ->searchable()
                            ->relationship('roles', 'name', fn (Role $role) => $role::where('id', '!=', 1))
                            ->preload()
                            ->visible(Auth::user()->hasPermissionTo('role.update')),*/
                        Select::make('id_curso')
                            ->label('Curso')
                            ->options(
                                AdCursos::all()->mapWithKeys(fn ($curso) => [
                                    $curso->id => "{$curso->nome_curso} (PPC {$curso->ppc})"
                                ])->toArray()
                            )
                            ->searchable()
                            ->preload(),
                        Select::make('id_professor')
                            ->label('Professor')
                            ->options(fn () => User::whereColumn('id', 'id_professor')->pluck('name', 'id'))
                            ->searchable()
                            ->preload(),
                    ])->columns(3),
            ]);
    }

    public function updateSystemSettingsForm(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('pages.system.settings'))
                    ->description(__('pages.system.settings.desc'))
                    ->schema([
                        Select::make('language')
                            ->label(__('pages.system.settings.language'))
                            ->options($this->getLanguageOptions())
                            ->native(false)
                            ->reactive()
                            ->required()
                            ->default('en'),
                    ])->columns(1),
            ]);
    }

    private function getLanguageOptions(): array
    {
        return [
            'en' => 'English',
            'pt' => 'Português',
            'es' => 'Español',
        ];
    }
}
