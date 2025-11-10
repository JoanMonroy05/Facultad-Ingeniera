<?php

namespace App\Http\Controllers\Admin;

use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CredencialesEstudiante;

class EstudianteController
{
    public function index()
    {
        $estudiantes = Estudiante::with('user')->get();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|string|unique:users,documento',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'required|string|max:255',
            'programa' => 'required|string|max:255',
            'semestre' => 'required|integer|min:1|max:10',
        ]);

        // Generar prefijo según el programa
        $prefijos = [
            'Ingenieria de Sistemas' => '19',
            'Ingenieria Mecanica' => '18',
            'Ingenieria Civil' => '17',
        ];

        $prefijo = $prefijos[$request->programa] ?? '00';
        
        // Buscar el último código de ese programa
        $ultimo = Estudiante::where('programa', $request->programa)
            ->orderBy('id', 'desc')
            ->first();

        if ($ultimo) {
            // Extraer los últimos 4 dígitos y sumar 1
            $ultimoNumero = intval(substr($ultimo->codigo, 2)); 
            $nuevoNumero = str_pad($ultimoNumero + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Primer estudiante del programa
            $nuevoNumero = '0001';
        }

        $codigo = $prefijo . $nuevoNumero;

        // Generar email automáticamente
        $email = User::generarEmail(
            $request->primer_nombre,
            $request->segundo_nombre,
            $request->primer_apellido,
            $request->segundo_apellido
        );

        // Generar una contraseña aleatoria de 10 caracteres
        $passwordPlano = Str::random(10);

        // Crear usuario asociado
        $user = User::create([
            'documento' => $request->documento,
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'email' => $email,
            'password' => Hash::make($passwordPlano),
        ]);

        // Asignar rol de estudiante
        $user->assignRole('estudiante');

        // Crear estudiante vinculado
        Estudiante::create([
            'user_id' => $user->id,
            'programa' => $request->programa,
            'codigo' => $codigo,
            'semestre' => $request->semestre,
        ]);

        // ✉️ Enviar correo al estudiante con sus credenciales
        Mail::to($email)->send(new CredencialesEstudiante($email, $passwordPlano));

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante creado exitosamente.');
    }

    public function show(Estudiante $estudiante)
    {
        
    }

    public function edit(Estudiante $estudiante)
    {
        $estudiante->load('user');
        return view('estudiantes.edit', compact('estudiante'));
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $estudiante->load('user');

        $request->validate([
            'documento' => 'required|string|unique:users,documento,' . $estudiante->user->id,
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'required|string|max:255',
            'programa' => 'required|string|max:255',
            'semestre' => 'required|integer|min:1|max:10',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Actualizar datos del usuario 
        $userData = [
            'documento' => $request->documento,
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
        ];

        // Si el admin escribió una nueva contraseña, se actualiza
        if (!empty($request->password)) {
            $userData['password'] = Hash::make($request->password);
        }

        $estudiante->user->update($userData);

        // Actualizar datos del estudiante
        $estudiante->update([
            'programa' => $request->programa,
            'semestre' => $request->semestre,
        ]);

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante actualizado correctamente.');
    }


    public function destroy(Estudiante $estudiante)
    {
        $user = $estudiante->user;
        
        // Eliminar estudiante primero (por la clave foránea)
        $estudiante->delete();
        
        // Luego eliminar usuario
        $user->delete();

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante eliminado exitosamente.');
    }
};