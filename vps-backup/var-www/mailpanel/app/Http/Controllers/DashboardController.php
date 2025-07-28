<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Models\Buzon;
use App\Models\Dominio;

class DashboardController extends Controller
{
    public function index()
    {
        // Total de buzones activos
        $totalBuzones = Buzon::count();

        // Dominios validados (asumiendo campo 'valido')
        $dominiosValidados = Dominio::where('valido', true)->count();

        // Ejemplo de tasa de entrega (método custom o cálculo real)
        $tasaEntrega = 98; // porcentaje fijo de ejemplo

        // Últimas acciones de ejemplo (aquí puedes traer tu propio log o modelo de acciones)
        $ultimasAcciones = collect([
            (object)['desc' => 'Usuario creó buzón prueba@ejemplo.cl', 'fecha' => now()->subHours(2)],
            (object)['desc' => 'Dominio midominio.cl validado',     'fecha' => now()->subHours(4)],
        ]);

        // Suscripciones activas para SuperAdmin
        $activeSubscriptions = Subscription::where('status', 'active')
            ->orderBy('expires_at')
            ->get(['domain', 'quantity', 'expires_at']);

        // Datos de ejemplo para el gráfico
        $fechasUltimaSemana = ['28/05', '29/05', '30/05', '31/05', '01/06', '02/06', '03/06'];
        $datosEnviados      = [120, 150, 130, 170, 160, 180, 200];
        $datosEntregados    = [110, 140, 125, 160, 155, 175, 190];

        return view('vendor.adminlte.pages.dashboard', compact(
            'totalBuzones',
            'dominiosValidados',
            'tasaEntrega',
            'ultimasAcciones',
            'fechasUltimaSemana',
            'datosEnviados',
            'datosEntregados',
            'activeSubscriptions'  // ← Aquí va la coma antes de este elemento
        ));
    }
}
