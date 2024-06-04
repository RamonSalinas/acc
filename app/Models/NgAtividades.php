<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgAtividades extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'grupo_atividades',
        'nome_atividade',
        'valor_unitario',
        'percentual_maximo',
    ];

    public function ngCertificados()
    {
        return $this->hasMany(NgCertificados::class, 'id_tipo_Atividade');
    }
}
