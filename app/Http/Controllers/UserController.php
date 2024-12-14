<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Listar todos los usuarios
    public function index()
    {
        return User::all();
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        return User::findOrFail($id);
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(null, 204);
    }

        //autenticar
        // Autenticar usuario con email y password
    public function authenticate(Request $request)
    {
        // Validar entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buscar usuario con email y password
        $user = User::where('email', $request->email)
                    ->where('password', $request->password) // Sin encriptar, como en tu proyecto actual
                    ->first();

        if ($user) {
            // Retornar el usuario si las credenciales son válidas
            return response()->json($user, 200);
        }

        // Retornar error si las credenciales no son válidas
        return response()->json(['error' => 'Credenciales incorrectas.'], 401);
    }

}

