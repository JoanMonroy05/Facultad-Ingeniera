<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'programa',
        'codigo',
        'semestre',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
