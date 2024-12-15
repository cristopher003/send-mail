@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listas de Correo</h1>

    <a href="{{ route('user-lists.create') }}" class="btn btn-primary mb-3">Crear Lista de Correo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Usuarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mailingLists as $mailingList)
                <tr>
                    <td>{{ $mailingList->name }}</td>
                    <td>{{ $mailingList->description }}</td>
                    <td>
                        @foreach($mailingList->users as $user)
                            <span>{{ $user->name }} ({{ $user->email }})</span><br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('user-lists.edit', $mailingList->id) }}" class="btn btn-warning">Editar</a>

                        <form action="{{ route('user-lists.destroy', $mailingList->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
