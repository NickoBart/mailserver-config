@extends('adminlte::page')

@section('title', 'Nuevo Ticket de Soporte')

@section('content')
<div class="container mx-auto py-8">
  <h1 class="text-2xl font-bold mb-4">Nuevo Ticket de Soporte</h1>
  <form action="{{ route('support.tickets.store') }}"
        method="POST"
        enctype="multipart/form-data">
    @csrf

    <div class="mb-4">
      <label class="block">Asunto</label>
      <input type="text"
             name="subject"
             value="{{ old('subject') }}"
             class="w-full border p-2"
             required>
      @error('subject')<p class="text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="mb-4">
      <label class="block">Mensaje</label>
      <textarea name="initial_message"
                rows="5"
                class="w-full border p-2"
                required>{{ old('initial_message') }}</textarea>
      @error('initial_message')<p class="text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="mb-4">
      <label class="block">Adjuntos (max 10 MB c/u)</label>
      <input type="file"
             name="attachments[]"
             multiple
             class="w-full border p-2">
      @error('attachments.*')<p class="text-red-600">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
    <a href="{{ route('support.tickets.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection
