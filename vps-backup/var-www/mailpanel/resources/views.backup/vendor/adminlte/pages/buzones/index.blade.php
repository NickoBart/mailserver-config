@extends('adminlte::page')

@section('css')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    {{-- Tu custom-adminlte.css si lo necesitas --}}
    <link rel="stylesheet" href="{{ asset('css/custom-adminlte.css') }}">
@stop

@section('title', 'Listado de Buzones')

@section('content_header')
    <h1>Buzones</h1>
    <a href="{{ route('buzones.create') }}" class="btn btn-success">Nuevo Buzón</a>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table id="tabla-buzones" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Local</th>
                        <th>Dominio</th>
                        <th>Creado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('js')
    {{-- jQuery y DataTables --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabla-buzones').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('buzones.datatables') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'local', name: 'local' },
                    { data: 'dominio', name: 'dominio' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'acciones', name: 'acciones', orderable: false, searchable: false },
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                },
                responsive: true,
            });
        });
    </script>
@stop
