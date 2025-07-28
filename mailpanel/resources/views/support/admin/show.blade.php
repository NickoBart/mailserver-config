@extends('adminlte::page')

@section('title', "Ticket #{$ticket->id}")

@section('content')
<div class="container-fluid py-4">
  <h1 class="h3 mb-4 text-gray-800">
    Ticket #{{ $ticket->id }} – {{ $ticket->subject }}
  </h1>

  {{-- Asignar --}}
  <form action="{{ route('admin.support.tickets.assign', $ticket) }}"
        method="POST"
        class="form-inline mb-4">
    @csrf
    <label class="mr-2">Asignar a:</label>
    <select name="assigned_to" class="form-control mr-2">
      <option value="">— Ninguno —</option>
      @foreach(\App\Models\User::all() as $user)
        <option value="{{ $user->id }}" {{ $ticket->assigned_to == $user->id ? 'selected' : '' }}>
          {{ $user->email }}
        </option>
      @endforeach
    </select>
    <button class="btn btn-primary">Asignar</button>
  </form>

  {{-- Estado --}}
  <form action="{{ route('admin.support.tickets.update', $ticket) }}"
        method="POST"
        class="form-inline mb-4">
    @csrf @method('PUT')
    <label class="mr-2">Estado:</label>
    <select name="status" class="form-control mr-2">
      @foreach(['abierto','en_proceso','resuelto'] as $st)
        <option value="{{ $st }}" {{ $ticket->status == $st ? 'selected' : '' }}>
          {{ ucfirst($st) }}
        </option>
      @endforeach
    </select>
    <button class="btn btn-secondary">Actualizar</button>
  </form>

  {{-- Mensaje inicial --}}
  <div class="card mb-4">
    <div class="card-body">
      <p><strong>Mensaje inicial:</strong></p>
      <p>{{ $ticket->initial_message }}</p>
      @foreach($ticket->messages->first()->attachments as $att)
        @php $ext = strtolower(pathinfo($att->filename, PATHINFO_EXTENSION)); @endphp
        <div class="mt-2 flex items-center">
          @if(in_array($ext, ['jpg','jpeg','png','gif']))
            <img src="{{ asset('storage/'.$att->filepath) }}"
                 alt="{{ $att->filename }}"
                 class="max-w-xs max-h-48 border rounded mr-2">
          @endif
          <a href="{{ asset('storage/'.$att->filepath) }}" target="_blank" class="text-blue-600">
            📎 {{ $att->filename }}
          </a>
          <form action="{{ route('admin.support.tickets.attachments.destroy', [$ticket, $att]) }}"
                method="POST" class="ml-4">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-500 text-sm">Eliminar</button>
          </form>
        </div>
      @endforeach
    </div>
  </div>

  {{-- Conversación --}}
  <h2 class="h5 mb-2">Conversación</h2>
  @foreach($messages as $msg)
    <div class="mb-3">
      <p class="small text-muted">
        {{ $msg->author->email }} · {{ $msg->created_at->format('d-m-Y H:i') }}
      </p>
      <div class="border p-2 mb-2">{{ $msg->message }}</div>
      @foreach($msg->attachments as $att)
        @php $ext = strtolower(pathinfo($att->filename, PATHINFO_EXTENSION)); @endphp
        <div class="mt-2 flex items-center">
          @if(in_array($ext, ['jpg','jpeg','png','gif']))
            <img src="{{ asset('storage/'.$att->filepath) }}"
                 alt="{{ $att->filename }}"
                 class="max-w-xs max-h-48 border rounded mr-2">
          @endif
          <a href="{{ asset('storage/'.$att->filepath) }}" target="_blank" class="text-blue-600">
            📎 {{ $att->filename }}
          </a>
          <form action="{{ route('admin.support.tickets.attachments.destroy', [$ticket, $att]) }}"
                method="POST" class="ml-4">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-500 text-sm">Eliminar</button>
          </form>
        </div>
      @endforeach
    </div>
  @endforeach

  {{-- Responder --}}
  <form action="{{ route('admin.support.tickets.reply', $ticket) }}"
        method="POST"
        enctype="multipart/form-data">
    @csrf
    <div class="form-group mb-3">
      <label>Respuesta:</label>
      <textarea name="message" rows="4" class="form-control" required></textarea>
      @error('message')<p class="text-danger">{{ $message }}</p>@enderror
    </div>
    <div class="form-group mb-4">
      <label>Adjuntos (max 10 MB c/u)</label>
      <input type="file" name="attachments[]" multiple class="form-control">
      @error('attachments.*')<p class="text-danger">{{ $message }}</p>@enderror
    </div>
    <button class="btn btn-success">Enviar respuesta</button>
  </form>
</div>
@endsection
