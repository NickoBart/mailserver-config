@extends('adminlte::page')

@section('title', 'Crear Buzón')

@section('content_header')
    <h1>Nuevo Buzón</h1>
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

            <form action="{{ route('buzones.store') }}" method="POST">
                @csrf

                {{-- 1) Local (parte antes de "@") --}}
                <div class="form-group">
                    <label for="local">Usuario (<small>antes de @</small>)</label>
                    <div class="input-group">
                        <input type="text"
                               name="local"
                               id="local"
                               class="form-control @error('local') is-invalid @enderror"
                               value="{{ old('local') }}"
                               required>
                        <div class="input-group-append">
                            {{-- Si hay un dominio en la colección, lo mostramos fijo --}}
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

                {{-- 2) Contraseña --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- 3) Confirmar Contraseña --}}
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Password</label>
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           required>
                    @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- 4) Dropdown con los dominios (solo uno, en teoría) --}}
                <div class="form-group">
                    <label for="client_domain_id">Dominio</label>
                    <select name="client_domain_id"
                            id="client_domain_id"
                            class="form-control @error('client_domain_id') is-invalid @enderror"
                            required>
                        <option value="">-- Selecciona un dominio --</option>
                        @foreach ($dominios as $d)
                            <option value="{{ $d->id }}"
                                    {{ old('client_domain_id') == $d->id ? 'selected' : '' }}>
                                {{ $d->domain }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_domain_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Crear Buzón</button>
                <a href="{{ route('buzones.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
