@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Usuarios</h1>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Crear Nuevo Usuario</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Aquí podríamos agregar botones de editar y eliminar si es necesario -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
