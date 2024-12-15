@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Usuario</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>


        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>
</div>
@endsection
