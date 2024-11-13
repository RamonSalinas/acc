<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImprimirRelatorioAvaliador extends Model
{
    use HasFactory;

    protected $table = 'progressao'; // Certifique-se de que está usando o nome correto da tabela

    protected $fillable = [
       'professor_id',
        'nome_progressao', 
        'intersticio_data_inicial', 
        'intersticio_data_final',
        'classe',
        'regime',
        'nivel',
        'data_ultima_progressao'
    ];

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function certificados()
    {
        return $this->hasMany(NgCertificadosProgressao::class, 'progressao_id', 'id');
    }
}
