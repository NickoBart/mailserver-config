@extends('layouts.admin')

@section('title', 'Editar Dominio')

@section('content_header')
  <h1>Editar Dominio</h1>
@stop

@section('content')
  <form action="{{ route('dominios.update', $dominio->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- Si es superusuario, mostramos dropdown de clientes --}}
    @if($isSuper)
      <div class="form-group mb-3">
        <label for="client_id">Cliente</label>
        <select name="client_id" id="client_id"
                class="form-control @error('client_id') is-invalid @enderror"
                required>
          <option value="">-- Selecciona un cliente --</option>
          @foreach($clientes as $c)
            <option value="{{ $c->id }}"
                    {{ $dominio->client_id == $c->id ? 'selected' : '' }}>
              {{ $c->email }}
            </option>
          @endforeach
        </select>
        @error('client_id')
          <span class="invalid-feedback">{{ $message }}</span>
        @enderror
      </div>
    @endif

    {{-- Campo “Dominio” --}}
    <div class="form-group mb-3">
      <label for="domain">Dominio</label>
      <input type="text"
             name="domain"
             id="domain"
             class="form-control @error('domain') is-invalid @enderror"
             value="{{ old('domain', $dominio->domain) }}"
             required>
      @error('domain')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    {{-- Campo “Verificado” --}}
    <div class="form-group mb-3">
      <label for="verified">Verificado</label>
      <select name="verified"
              id="verified"
              class="form-control @error('verified') is-invalid @enderror">
        <option value="0" {{ $dominio->verified == 0 ? 'selected' : '' }}>Pendiente</option>
        <option value="1" {{ $dominio->verified == 1 ? 'selected' : '' }}>Verificado</option>
      </select>
      @error('verified')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">
      <i class="fas fa-save"></i> Guardar
    </button>
    <a href="{{ route('dominios.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Cancelar
    </a>
  </form>
@stop
