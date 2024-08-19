<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progressao extends Model
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
        'data_ultima_progressao',
        'nome_direcao', // Novo campo
        'licence_maternidade', // Novo campo
        'data_inicial_licenca', // Novo campo
        'data_final_licenca' // Novo campo
    ];

   // public function professor()
   // {
   //     return $this->belongsTo(Professor::class);
   // }

    public function professor()
    {
        return $this->belongsTo(Professor::class, 'professor_id');
    }
}
