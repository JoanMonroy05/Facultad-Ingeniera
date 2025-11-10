<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CredencialesEstudiante;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::with('user')->get();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|string|unique:users,documento',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'especialidad' => 'nullable|string|max:255',
            'titulo' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        // Generar email automáticamente según el método del modelo User
        $email = User::generarEmail(
            $request->primer_nombre,
            $request->segundo_nombre,
            $request->primer_apellido,
            $request->segundo_apellido
        );

        // Generar contraseña aleatoria
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

        // Asignar rol de docente
        $user->assignRole('docente');

        // Crear el registro del docente
        Docente::create([
            'user_id' => $user->id,
            'especialidad' => $request->especialidad,
            'titulo' => $request->titulo,
            'telefono' => $request->telefono,
        ]);

        // Enviar correo al docente con credenciales (si existe la clase Mailable)
        Mail::to($email)->send(new CredencialesEstudiante($email, $passwordPlano));

        return redirect()->route('docentes.index')
            ->with('success', 'Docente creado exitosamente.');
    }

    public function edit(Docente $docente)
    {
        $docente->load('user');
        return view('docentes.edit', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $docente->load('user');

        $request->validate([
            'documento' => 'required|string|unique:users,documento,' . $docente->user->id,
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'especialidad' => 'nullable|string|max:255',
            'titulo' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
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

        if (!empty($request->password)) {
            $userData['password'] = Hash::make($request->password);
        }

        $docente->user->update($userData);

        // Actualizar datos del docente
        $docente->update([
            'especialidad' => $request->especialidad,
            'titulo' => $request->titulo,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('docentes.index')
            ->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Docente $docente)
    {
        $user = $docente->user;

        // Eliminar docente primero
        $docente->delete();

        // Luego eliminar usuario
        $user->delete();

        return redirect()->route('docentes.index')
            ->with('success', 'Docente eliminado exitosamente.');
    }
}
