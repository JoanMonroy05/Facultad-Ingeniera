<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'horario_id',
        'estudiante_id',
        'fecha',
        'presente',
    ];

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
