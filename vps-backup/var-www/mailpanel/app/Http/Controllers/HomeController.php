<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Mostrar la página de inicio pública.
     */
    public function index()
    {
        // Lee las características y testimonios desde JSON
        $features = json_decode(
            file_get_contents(resource_path('data/features.json')),
            true
        );
        $testimonios = json_decode(
            file_get_contents(resource_path('data/testimonios.json')),
            true
        );

        // Logos de clientes (coloca los archivos en public/images/logos/)
        $logos = [
            'images/logos/astrotech.png',
            'images/logos/cloudsync.png',
            'images/logos/mailforge.png',
            // añade más según necesites
        ];

        // FAQs para el bloque destacado en Home
        $faqs = [
            [
                'question' => '¿Cómo migro mis buzones?',
                'answer'   => 'Puedes usar nuestra herramienta de migración automática en el panel de control.',
            ],
            [
                'question' => '¿Qué capacidad tengo gratis?',
                'answer'   => 'El plan Free incluye 1 buzón y 1 dominio por 30 días.',
            ],
            [
                'question' => '¿Cómo contacto soporte?',
                'answer'   => 'En la esquina inferior derecha tienes el botón “Soporte”.',
            ],
        ];

        return view('home', compact('features', 'testimonios', 'logos', 'faqs'));
    }
}
