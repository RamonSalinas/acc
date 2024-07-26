<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NgCertificadosProgressao extends Model
{
    use HasFactory;

    protected $table = 'ng_certificados_progressao';
    

    protected $fillable = [
        'ad_grupo_progressao_id',
        'ng_atividades_progressao_id',
        'referencia',
        'quantidade',
        'pontuacao',
        'arquivo_progressao',
        'data_inicial',
        'data_final',
        'observacao',
        'status',
        'id_usuario',
        'progressao_id',

    ];

    public function grupoProgressao()
    {
        return $this->belongsTo(AdGrupoProgressao::class, 'ad_grupo_progressao_id');
       

    }

    public function adGrupoProgressao()
    {
        return $this->belongsTo(NgAtividadesProgressao::class, 'ng_atividades_progressao_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

  
public function ngCertificadosProgressao()
{
    return $this->hasMany(NgCertificadosProgressao::class, 'ng_atividades_progressao_id');
}

    protected static function booted()
    {
        static::creating(function ($certificado) {
            if (auth()->check()) {
                $certificado->id_usuario = auth()->id();
                // Definir um valor padrão para pontuacao se não estiver definido

            }

        });
    }

}