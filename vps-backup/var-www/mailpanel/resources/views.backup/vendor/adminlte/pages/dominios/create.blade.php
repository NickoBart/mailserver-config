{{-- resources/views/vendor/adminlte/pages/dominios/create.blade.php --}}
@extends('adminlte::page')

@section('title', 'Agregar Dominio')

@section('content_header')
  <h1>Agregar Dominio</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('dominios.store') }}" method="POST">
        @csrf

        @if($isSuper)
          <div class="form-group">
            <label for="client_id">Cliente</label>
            <select name="client_id" id="client_id"
                    class="form-control @error('client_id') is-invalid @enderror"
                    required>
              <option value="">— Seleccione un cliente —</option>
              @foreach($clientes as $c)
                <option value="{{ $c->id }}"
                        {{ old('client_id') == $c->id ? 'selected' : '' }}>
                  {{ $c->email }}
                </option>
              @endforeach
            </select>
            @error('client_id')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        @endif

        <div class="form-group">
          <label for="domain">Dominio</label>
          <input type="text"
                 name="domain"
                 id="domain"
                 class="form-control @error('domain') is-invalid @enderror"
                 value="{{ old('domain') }}"
                 required>
          @error('domain')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit" class="btn btn-success">
          <i class="fas fa-save"></i> Guardar
        </button>
        <a href="{{ route('dominios.index') }}" class="btn btn-default">
          <i class="fas fa-arrow-left"></i> Cancelar
        </a>
      </form>
    </div>
  </div>
@stop
