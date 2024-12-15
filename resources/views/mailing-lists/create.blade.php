@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Lista de Correo</h1>
    <form method="POST" action="{{ route('mailing-lists.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la Lista</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="users" class="form-label">Seleccionar Usuarios</label>
            <select name="users[]" id="users" class="form-control" multiple>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear Lista</button>
    </form>
</div>
@endsection
