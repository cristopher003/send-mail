@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Enviar Correo</h1>
    <form method="POST" action="{{ route('emails.send') }}">
        @csrf
        <div class="mb-3">
            <label for="recipients" class="form-label">Destinatarios</label>
            <select name="recipients[]" id="recipients" class="form-control" multiple>
                @foreach($mailingLists as $list)
                    <option value="list:{{ $list->id }}">Lista: {{ $list->name }}</option>
                @endforeach
                @foreach($users as $user)
                    <option value="user:{{ $user->id }}">Usuario: {{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label">Asunto</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Mensaje</label>
            <textarea name="message" id="message" class="form-control" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script>
    var quill = new Quill('#message', { theme: 'snow' });
</script>
@endpush
