<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Mostrar la página de preguntas frecuentes.
     */
    public function index()
    {
        // Define aquí el listado de FAQs completo
        $faqs = [
            [
                'question' => '¿Cómo registro mi dominio?',
                'answer'   => 'Ve a <strong>Dominios → Nuevo dominio</strong>, ingresa tu nombre y sigue el asistente de validación DNS.',
            ],
            [
                'question' => '¿Cuál es el tamaño máximo de buzón?',
                'answer'   => 'Depende del plan: desde 500 MB (Básico) hasta 5 GB (Enterprise).',
            ],
            [
                'question' => '¿Ofrecen migración desde otros proveedores?',
                'answer'   => 'Sí, asistimos gratis en la migración de mensajes desde Gmail, Office 365 y otros.',
            ],
            [
                'question' => '¿Cómo funciona la prueba gratuita?',
                'answer'   => 'Activa cualquier plan durante 30 días: sin cobros y sin restricciones.',
            ],
            [
                'question' => '¿Qué métodos de pago aceptan?',
                'answer'   => 'Stripe (tarjetas), PayPal y transferencia bancaria.',
            ],
        ];

        return view('faq', compact('faqs'));
    }
}

