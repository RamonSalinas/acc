<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'id_tipo_atividade',
        'id_usuario',
        'horas_ACC',
        'type',
        'grupo_atividades', // Certifique-se de que o campo grupo_atividades está presente
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function ngAtividade()
    {
        return $this->belongsTo(NgAtividades::class, 'id_tipo_atividade');
    }

    public function grupoAtividades()
    {
        return $this->belongsTo(AdGrupo::class, 'id');

    }
}
