@extends('adminlte::page')

@section('title', 'Editar Buzón')

@section('content_header')
    <h1>Editar Buzón</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Mostrar errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('buzones.update', ['buzone' => $buzon->id]) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- 1) Local (parte antes de "@") --}}
                @php
                    $localPart = strstr($buzon->login, '@', true);
                @endphp
                <div class="form-group">
                    <label for="local">Usuario (<small>antes de @</small>)</label>
                    <div class="input-group">
                        <input type="text"
                               name="local"
                               id="local"
                               class="form-control @error('local') is-invalid @enderror"
                               value="{{ old('local', $localPart) }}"
                               required>
                        <div class="input-group-append">
                            {{-- Dominio fijo --}}
                            <span class="input-group-text">
                                @if($dominios->isNotEmpty())
                                    @php $simpleDomain = $dominios->first()->domain; @endphp
                                    <code>@{{ $simpleDomain }}</code>
                                @else
                                    <code>@dominio</code>
                                @endif
                            </span>
                        </div>
                    </div>
                    @error('local')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- 2) Nuevo Password (opcional) --}}
                <small class="text-muted">Dejar en blanco si no quieres cambiar la contraseña.</small>
                <div class="form-group mt-2">
                    <label for="password">Password</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- 3) Confirmar nuevo Password --}}
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Password</label>
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- 4) Dropdown solo con el dominio --}}
                <div class="form-group">
                    <label for="client_domain_id">Dominio</label>
                    <select name="client_domain_id"
                            id="client_domain_id"
                            class="form-control @error('client_domain_id') is-invalid @enderror"
                            required>
                        <option value="">-- Selecciona un dominio --</option>
                        @foreach ($dominios as $d)
                            <option value="{{ $d->id }}"
                                {{ old('client_domain_id', $buzon->client_domain_id) == $d->id ? 'selected' : '' }}>
                                {{ $d->domain }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_domain_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Buzón</button>
                <a href="{{ route('buzones.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
