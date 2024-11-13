<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'professors';

    protected $fillable = [
        'user_id', 'email', 'siape', 'lotacao', 'admissao',
        'classe', 'regime', 'nivel', 'data_ultima_progressao',
        'intersticio_data_inicial', 'intersticio_data_final'
    ];

    public function progressaos()
    {
        return $this->hasMany(Progressao::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}