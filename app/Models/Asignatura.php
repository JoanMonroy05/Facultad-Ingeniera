<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'creditos',
    ];

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
