<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdGrupoProgressao extends Model
{
    use HasFactory;
    protected $table = 'ad_grupo_progressao';

    protected $fillable = [
        'nome_grupo_progressao',
    ];

    public function ngCertificadosProgressao()
    {
        return $this->hasMany(NgCertificados::class, 'grupo_atividades_progressao', 'id');
    }

}