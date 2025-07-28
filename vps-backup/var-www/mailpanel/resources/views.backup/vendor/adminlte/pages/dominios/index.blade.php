{{-- resources/views/vendor/adminlte/pages/dominios/index.blade.php --}}
@extends('adminlte::page')

{{-- Activa el plugin DataTables de AdminLTE --}}
@section('plugins.Datatables', true)

@section('title', 'Dominios')

@section('content_header')
    <h1>Dominios</h1>
    @if(isset($isSuper) && $isSuper)
        <small class="text-muted">Modo Superadministrador</small>
    @endif
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('dominios.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo dominio
            </a>
        </div>
        <div class="card-body p-0">
            <table id="tabla-dominios" class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        @if($isSuper)
                            <th>Cliente</th>
                        @endif
                        <th>ID</th>
                        <th>Dominio</th>
                        <th>Casillas</th>
                        <th>Buzones usados</th>
                        <th>Vencimiento</th>
                        <th>Estado</th>
                        <th>Creado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('js')
<script>
$(function() {
  $('#tabla-dominios').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('dominios.datatables') }}",
    columns: [
      @if($isSuper)
        { data: 'cliente',       name: 'cliente' },
      @endif
      { data: 'id',             name: 'id' },
      { data: 'domain',         name: 'domain' },
      { data: 'casillas',       name: 'casillas' },
      { data: 'buzones_usados', name: 'buzones_usados' },
      { data: 'vencimiento',    name: 'vencimiento' },
      { data: 'estado',         name: 'estado' },
      { data: 'created_at',     name: 'created_at' },
      { data: 'acciones',       orderable: false, searchable: false }
    ],
    responsive: true,
    language: {
      url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
    }
  });
});
</script>
@stop
