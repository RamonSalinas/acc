<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdGrupo extends Model
{
    use HasFactory;
    protected $table = 'ad_grupo';

    protected $fillable = [
        'nome_grupo',
    ];

    public function ngCertificados()
    {
        return $this->hasMany(NgCertificados::class, 'grupo_atividades', 'id');
    }


    
}

