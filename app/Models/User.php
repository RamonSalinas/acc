<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use App\Http\Traits\UserTrait;
use Filament\Panel;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, HasRoles, UserTrait;

    protected $fillable = [
        'name',
        'cpf',
        'email',
        'password',
        'is_active',
        'id_curso',
        'id_professor',
        'periodo', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->id == 1 && $this->hasRole($this->SUPER_ADMIN);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole($this->ADMIN);
    }

    public function isUser(): bool
    {
        return $this->hasRole($this->USER);
    }

    public function isEspecialista(): bool
    {
        return $this->hasRole($this->ESPECIALISTA);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole([$this->SUPER_ADMIN, $this->ADMIN, $this->USER, $this->ESPECIALISTA]) && $this->is_active;
    }

    public function ng_certificado()
    {
        return $this->belongsToMany(NgCertificados::class);
    }

    public function ng_cursos()
    {
        return $this->hasMany(AdCursos::class);
    }

    public function professores()
    {
       return $this->belongsToMany(Professor::class, 'professor_user', 'user_id', 'professor_id');
}

    // Relacionamento belongsToMany
    public function professoreshasMany()
    {
        return $this->hasMany(Professor::class, 'user_id');

    }
    public function ngCertificados()
    {
        return $this->belongsToMany(NgCertificados::class, 'ng_certificado_user', 'user_id', 'ng_certificados_id');
    }

    public function curso()
    {
        return $this->belongsTo(AdCursos::class, 'id_curso');
    }

    public function certificados()
    {
        return $this->hasMany(NgCertificados::class, 'id_usuario');
    }
}