@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Lista de Correo</h1>

    <form action="{{ route('user-lists.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nombre de la Lista</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="users">Seleccionar Usuarios</label>
            <select class="form-control" id="users" name="users[]" multiple required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            <small class="form-text text-muted">Selecciona uno o más usuarios para agregar a la lista.</small>
        </div>

        <button type="submit" class="btn btn-primary">Crear Lista</button>
    </form>
</div>
@endsection
