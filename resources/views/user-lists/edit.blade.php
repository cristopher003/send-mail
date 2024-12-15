@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Lista de Correo: {{ $mailingList->name }}</h1>

    <form action="{{ route('user-lists.update', $mailingList->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre de la Lista</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $mailingList->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $mailingList->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="users">Seleccionar Usuarios</label>
            <select class="form-control" id="users" name="users[]" multiple required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ in_array($user->id, $mailingList->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Selecciona uno o más usuarios para agregar a la lista.</small>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Lista</button>
    </form>
</div>
@endsection
