@extends('adminlte::page')

@section('title', 'Configuración Global')

@section('content_header')
  <h1>Configuración Global</h1>
@stop

@section('content')
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="card-header">
      <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevo">
        <i class="fas fa-plus"></i> Nuevo parámetro
      </button>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Clave</th>
            <th>Valor</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($settings as $s)
            <tr>
              <td>{{ $s->key }}</td>
              <td>{{ $s->value }}</td>
              <td>
                <button class="btn btn-sm btn-primary"
                        data-toggle="modal"
                        data-target="#modalEditar{{ $s->id }}">
                  <i class="fas fa-edit"></i> Editar
                </button>
              </td>
            </tr>
            <!-- Modal Editar -->
            <div class="modal fade" id="modalEditar{{ $s->id }}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <form action="{{ route('configuracion.update',['setting'=>$s->id]) }}"
                      method="POST">
                  @csrf @method('PUT')
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Editar {{ $s->key }}</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="value">Valor</label>
                        <input type="text" name="value"
                               id="value"
                               class="form-control"
                               value="{{ old('value',$s->value) }}">
                        @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Nuevo -->
  <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form action="{{ route('configuracion.store') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Crear nuevo parámetro</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="key">Clave (key)</label>
              <input type="text" name="key" id="key" class="form-control" required>
              @error('key')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
              <label for="value">Valor</label>
              <input type="text" name="value" id="value" class="form-control" required>
              @error('value')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Crear</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@stop
