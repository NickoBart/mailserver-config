<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Mostrar la página “Acerca de”.
     */
    public function index()
    {
        // Métricas clave (puedes reemplazar los valores por dinámicos más adelante)
        $metrics = [
            ['label' => 'Buzones activos',              'value' => '🎯 1.234'],
            ['label' => 'Disponibilidad (uptime)',      'value' => '⏱ 99,9%'],
            ['label' => 'Tiempo medio de respuesta',    'value' => '⏳ < 10 min'],
            ['label' => 'NPS (satisfacción)',           'value' => '❤️ 75'],
            ['label' => 'Tasa de adopción de nuevas tools','value' => '🚀 65%'],
        ];

        return view('about.index', compact('metrics'));
    }
}
