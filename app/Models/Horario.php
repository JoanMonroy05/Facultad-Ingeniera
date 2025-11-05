<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'asignatura_id',
        'docente_id',
        'dia',
        'hora_inicio',
        'hora_fin',
        'aula',
    ];

    public function asignatura()
    {
        return $this->belongsTo(Asignatura::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
