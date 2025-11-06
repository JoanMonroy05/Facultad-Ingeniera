<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'documento',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Accessor para obtener el nombre completo
    public function getNombreCompletoAttribute(): string
    {
        return trim(
            $this->primer_nombre . ' ' . 
            ($this->segundo_nombre ?? '') . ' ' . 
            $this->primer_apellido . ' ' . 
            ($this->segundo_apellido ?? '')
        );
    }

    // Método para generar email automáticamente
    public static function generarEmail(
        string $primerNombre,
        ?string $segundoNombre,
        string $primerApellido,
        ?string $segundoApellido
    ): string {
        // Normalizar y limpiar texto (quitar tildes, espacios, convertir a minúsculas)
        $primerNombre = self::normalizar($primerNombre);
        $segundoNombre = $segundoNombre ? self::normalizar($segundoNombre) : '';
        $primerApellido = self::normalizar($primerApellido);
        $segundoApellido = $segundoApellido ? self::normalizar($segundoApellido) : '';
        
        // Construir el email según el nuevo formato:
        // Primera letra primer nombre + Primera letra segundo nombre +
        // Primer apellido completo + Primera letra segundo apellido
        $codigo = '';

        // Primera letra del primer nombre
        if (!empty($primerNombre)) {
            $codigo .= substr($primerNombre, 0, 1);
        }

        // Primera letra del segundo nombre (si existe)
        if (!empty($segundoNombre)) {
            $codigo .= substr($segundoNombre, 0, 1);
        }

        // Primer apellido completo
        $codigo .= $primerApellido;

        // Primera letra del segundo apellido (si existe)
        if (!empty($segundoApellido)) {
            $codigo .= substr($segundoApellido, 0, 1);
        }

        $email = strtolower($codigo) . '@ufpso.edu.co';

        // Verificar si el email ya existe y agregar número si es necesario
        $contador = 1;
        $emailOriginal = $email;

        while (self::where('email', $email)->exists()) {
            $email = strtolower($codigo) . $contador . '@ufpso.edu.co';
            $contador++;
        }

        return $email;
    }


    private static function normalizar(string $texto): string
    {
        $texto = trim($texto);
        
        // Reemplazar tildes y caracteres especiales
        $buscar = ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'];
        $reemplazar = ['a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u', 'n'];
        $texto = str_replace($buscar, $reemplazar, $texto);
        
        // Eliminar espacios y convertir a minúsculas
        $texto = strtolower($texto);
        
        // Eliminar caracteres que no sean letras
        $texto = preg_replace('/[^a-z]/', '', $texto);
        
        return $texto;
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class);
    }

    public function docente()
    {
        return $this->hasOne(Docente::class);
    }

}
