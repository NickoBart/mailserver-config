@extends('adminlte::page')

@section('title', "Renovar Suscripción de {$dominio->domain}")

@section('content_header')
    <h1>Renovar Suscripción de {{ $dominio->domain }}</h1>
@stop

@section('content')
    @php $user = auth()->user(); @endphp

    @if($user->email === 'admin@connectia.info')
        {{-- SUPERADMIN: Date-picker clásico --}}
        <form action="{{ route('dominios.renewManual', $dominio->id) }}" method="POST" class="max-w-md">
            @csrf
            <div class="form-group">
                <label for="expires_at">Fecha de término:</label>
                <input type="date" name="expires_at" id="expires_at" class="form-control" required>
            </div>
            <button class="btn btn-primary mt-2">
                <i class="fas fa-sync-alt"></i> Renovar
            </button>
            <a href="{{ route('dominios.index') }}" class="btn btn-default mt-2">Cancelar</a>
        </form>

    @else
        {{-- CLIENTE: Botones “1 mes” y “1 año” --}}
        @if($sub)
            <p><strong>Tu suscripción vence el:</strong> {{ $sub->expires_at->format('d-m-Y') }}</p>

            <form action="{{ route('subscriptions.reactivate', $sub->id) }}" method="POST" class="d-inline-block">
                @csrf
                <input type="hidden" name="period" value="monthly">
                <button class="btn btn-success">
                    Renovar 1 mes
                </button>
            </form>

            <form action="{{ route('subscriptions.reactivate', $sub->id) }}" method="POST" class="d-inline-block ml-2">
                @csrf
                <input type="hidden" name="period" value="annual">
                <button class="btn btn-success">
                    Renovar 1 año
                </button>
            </form>
        @else
            <div class="alert alert-info">
                No tienes suscripción activa que renovar.
            </div>
        @endif
    @endif
@stop
