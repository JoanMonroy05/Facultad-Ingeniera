<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'especialidad',
        'titulo',
        'telefono',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
}
