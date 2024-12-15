<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserListController extends Controller
{
    // Método para mostrar el formulario de creación de una lista de correos
    public function create()
    {
        $users = User::all(); // Obtener todos los usuarios existentes
        return view('user-lists.create', compact('users')); // Pasar los usuarios a la vista
    }

    // Método para almacenar la nueva lista de correos
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'users' => 'required|array',
            'users.*' => 'exists:users,id'  // Validar que los IDs de los usuarios existan
        ]);

        DB::transaction(function () use ($validatedData) {
            // Crear la lista de correo
            $mailingList = MailingList::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'] ?? null
            ]);

            // Asociar los usuarios a la lista de correo
            if (isset($validatedData['users'])) {
                $mailingList->users()->attach($validatedData['users']);
            }
        });

        return redirect()->route('user-lists.index')
            ->with('success', 'Lista de correo creada exitosamente');
    }

    // Método para mostrar todas las listas de correo
    public function index()
    {
        $mailingLists = MailingList::with('users')->get();  // Obtener todas las listas con sus usuarios
        return view('user-lists.index', compact('mailingLists'));
    }

    // Método para editar una lista de correo
    public function edit(MailingList $mailingList)
    {
        $users = User::all(); // Obtener todos los usuarios
        return view('user-lists.edit', compact('mailingList', 'users'));
    }

    // Método para actualizar una lista de correo
    public function update(Request $request, MailingList $mailingList)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'users' => 'required|array',
            'users.*' => 'exists:users,id'
        ]);

        DB::transaction(function () use ($validatedData, $mailingList) {
            // Actualizar la lista de correo
            $mailingList->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'] ?? null
            ]);

            // Actualizar los usuarios asociados
            $mailingList->users()->sync($validatedData['users']);
        });

        return redirect()->route('user-lists.index')
            ->with('success', 'Lista de correo actualizada exitosamente');
    }

    // Método para eliminar una lista de correo
    public function destroy(MailingList $mailingList)
    {
        $mailingList->delete();
        return redirect()->route('user-lists.index')
            ->with('success', 'Lista de correo eliminada exitosamente');
    }
}