@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listas de Correo</h1>
    <a href="{{ route('mailing-lists.create') }}" class="btn btn-primary">Crear Nueva Lista</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lists as $list)
            <tr>
                <td>{{ $list->name }}</td>
                <td>
                    @foreach($list->users as $user)
                        <span class="badge bg-secondary">{{ $user->email }}</span>
                    @endforeach
                </td>
                <td>
                    <!-- Agregar acciones (editar, eliminar, etc.) -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
