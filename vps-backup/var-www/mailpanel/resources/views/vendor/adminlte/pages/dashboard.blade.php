@extends('adminlte::page')

{{-- Inyectamos nuestro CSS personalizado desde esta vista --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom-adminlte.css') }}">
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')
    {{-- ---------------------------------------------
         FRANJA DE ALERTA: Azul oscuro con texto blanco
         --------------------------------------------- --}}
    @if(isset($totalBuzones) && isset($dominiosValidados) && $totalBuzones == 0 && $dominiosValidados == 0)
        <div class="alert bg-primary text-white d-flex align-items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <div>
                Aún no tienes dominios ni buzones. <strong>Agrega tu primer dominio</strong> para empezar a enviar correos profesionales.
                <a href="{{ route('dominios.create') }}" class="btn btn-sm btn-outline-light ml-2">Agregar dominio</a>
            </div>
        </div>
    @endif

    <div class="row">
        {{-- Card 1: Total de buzones activos --}}
        <div class="col-lg-3 col-6">
            <div class="small-box small-box-light">
                <div class="inner">
                    <h3 class="text-blue">{{ $totalBuzones ?? 0 }}</h3>
                    <p class="text-gray">Buzones activos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope text-light-blue"></i>
                </div>
                <a href="{{ route('buzones.index') }}" class="small-box-footer footer-light-blue">
                    Ver buzones <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        {{-- Card 2: Dominios validados --}}
        <div class="col-lg-3 col-6">
            <div class="small-box small-box-light">
                <div class="inner">
                    <h3 class="text-blue">{{ $dominiosValidados ?? 0 }}</h3>
                    <p class="text-gray">Dominios validados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-globe text-light-blue"></i>
                </div>
                <a href="{{ route('dominios.index') }}" class="small-box-footer footer-light-blue">
                    Ver dominios <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        {{-- Card 3: Tasa de entrega --}}
        <div class="col-lg-3 col-6">
            <div class="small-box small-box-light">
                <div class="inner">
                    <h3 class="text-blue">{{ $tasaEntrega ?? 0 }}<sup style="font-size: 20px">%</sup></h3>
                    <p class="text-gray">Tasa de entrega<br><small>(Última semana)</small></p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line text-light-blue"></i>
                </div>
                <a href="{{ route('estadisticas.index') }}" class="small-box-footer footer-light-blue">
                    Ver estadísticas <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        {{-- Card 4: Últimas acciones --}}
        <div class="col-lg-3 col-6">
            <div class="small-box small-box-light">
                <div class="inner">
                    <h3 class="text-blue">{{ $ultimasAcciones->count() ?? 0 }}</h3>
                    <p class="text-gray">Acciones recientes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-history text-light-blue"></i>
                </div>
                <a href="{{ route('dashboard') }}" class="small-box-footer footer-light-blue">
                    Ver detalles <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Gráfico de ejemplo con Chart.js --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Envíos vs Entregas (Última semana)</h3>
                </div>
                <div class="card-body">
                    <canvas id="chartEmails" style="min-height: 250px"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Datos de ejemplo (estos arrays vendrán desde el controlador)
            var etiquetas = {!! json_encode($fechasUltimaSemana ?? []) !!};
            var datosEnviados = {!! json_encode($datosEnviados ?? []) !!};
            var datosEntregados = {!! json_encode($datosEntregados ?? []) !!};

            if (document.getElementById('chartEmails')) {
                var ctx = document.getElementById('chartEmails').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: etiquetas,
                        datasets: [
                            {
                                label               : 'Enviados',
                                backgroundColor     : 'rgba(60,141,188,0.3)',
                                borderColor         : 'rgba(60,141,188,0.8)',
                                pointRadius         : false,
                                data                : datosEnviados
                            },
                            {
                                label               : 'Entregados',
                                backgroundColor     : 'rgba(0,166,90,0.3)',
                                borderColor         : 'rgba(0,166,90,0.8)',
                                pointRadius         : false,
                                data                : datosEntregados
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
    {{-- ---------------------------------------------
         SECCIÓN SUPERADMIN: Dominios activos
         --------------------------------------------- --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Dominios Activos</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Dominio</th>
                                <th>Casillas</th>
                                <th>Vencimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($activeSubscriptions as $sub)
                            <tr>
                                <td>{{ $sub->domain }}</td>
                                <td>{{ $sub->quantity }}</td>
                                <td>
                                    {{ $sub->expires_at
                                        ? $sub->expires_at->format('d/m/Y H:i')
                                        : '–' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No hay suscripciones activas</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
