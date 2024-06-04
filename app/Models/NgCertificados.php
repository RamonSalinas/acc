<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pages\ListNgCertificados;
use Filament\Notifications\Notification;
use App\Models\AdCursos;
use App\Filament\Resources\NgCertificadosResource\Pages;

class NgCertificados extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_certificado',
        'carga_horaria',
        'descricao',
        'local',
        'data_inicio',
        'data_final',
        'id_tipo_Atividade',
        'id_usuario',
        'horas_ACC',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function ngAtividade()
    {
        return $this->belongsTo(NgAtividades::class, 'id_tipo_Atividade');
    }

  
}
