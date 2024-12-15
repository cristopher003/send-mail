<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Método para mostrar el formulario de creación de un nuevo usuario
    public function create()
    {
        return view('users.create');
    }

    // Método para almacenar un nuevo usuario
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    // Método para mostrar todos los usuarios
    public function index()
    {
        $users = User::all(); // Obtener todos los usuarios
        return view('users.index', compact('users'));
    }
}
