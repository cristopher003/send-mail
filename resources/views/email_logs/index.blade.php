@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estado de Envíos</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Email</th>
                <th>Estado</th>
                <th>Mensaje de Error</th>
                <th>Creado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->email }}</td>
                <td>{{ $log->status }}</td>
                <td>{{ $log->error_message }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $logs->links() }}
</div>
@endsection
