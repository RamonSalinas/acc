<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NgAtividadesProgressao extends Model
{
    protected $table = 'ng_atividades_progressao';

    protected $fillable = [
        'nome_da_atividade',
        'ad_grupo_progressao_id',
        'referencia',
    ];

    public function adGrupoProgressao(): BelongsTo
    {
        return $this->belongsTo(AdGrupoProgressao::class);
    }
}