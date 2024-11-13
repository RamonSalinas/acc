<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdCursos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_curso',
        'carga_horaria_curso',
        'carga_horaria_ACC',
        'carga_horaria_Extensao',
        'ppc',
        'email', // Adicione o campo email aqui

    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

