{{-- resources/views/vendor/adminlte/pages/estadisticas/index.blade.php --}}
@extends('adminlte::page')

@section('title', 'Estadísticas')

@section('content_header')
    <h1>Estadísticas Generales</h1>
@stop

@section('content')
    {{-- Small boxes --}}
    <div class="row">
        <div class="col-lg-2 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $diskUsage }}<sup style="font-size:20px">%</sup></h3>
                    <p>Uso de disco</p>
                </div>
                <div class="icon"><i class="fas fa-hdd"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $domainsCount }}</h3>
                    <p>Dominios</p>
                </div>
                <div class="icon"><i class="fas fa-globe"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $mailboxesCount }}</h3>
                    <p>Buzones</p>
                </div>
                <div class="icon"><i class="fas fa-envelope"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $bounceRate }}<sup style="font-size:20px">%</sup></h3>
                    <p>Bounce Rate</p>
                </div>
                <div class="icon"><i class="fas fa-chart-bar"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $dmarcRate }}<sup style="font-size:20px">%</sup></h3>
                    <p>DMARC Pass</p>
                </div>
                <div class="icon"><i class="fas fa-shield-alt"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $dkimRate }}<sup style="font-size:20px">%</sup></h3>
                    <p>DKIM Pass</p>
                </div>
                <div class="icon"><i class="fas fa-key"></i></div>
            </div>
        </div>
    </div>

    {{-- Tendencia y detalle --}}
    <div class="row mt-4">
        {{-- Gráfico de envíos vs rebotes --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Envíos vs Rebotes (últimos 7 días)</h3>
                </div>
                <div class="card-body">
                    <div style="height:300px">
                        <canvas id="chartTrend"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Top destinatarios y tamaño medio --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top Destinatarios (hoy)</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group mb-3">
                        @foreach($topRecipients as $rec)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $rec['email'] }}
                                <span class="badge badge-primary badge-pill">{{ $rec['count'] }}</span>
                            </li>
                        @endforeach
                        @if($topRecipients->isEmpty())
                            <li class="list-group-item text-muted">Sin datos</li>
                        @endif
                    </ul>
                    <p><strong>Tamaño medio de mensaje:</strong> {{ number_format($avgSize) }} bytes</p>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartTrend').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($trend->pluck('day')) !!},
                datasets: [
                    {
                        label: 'Enviados',
                        data: {!! json_encode($trend->pluck('sent')) !!},
                        borderWidth: 2,
                        fill: false,
                    },
                    {
                        label: 'Rebotes',
                        data: {!! json_encode($trend->pluck('bounce')) !!},
                        borderWidth: 2,
                        fill: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endpush
