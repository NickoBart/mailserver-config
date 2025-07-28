<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PricingController extends Controller
{
    /**
     * Mostrar la página de planes y precios.
     */
    public function index()
    {
        // 1) Traer todos los planes ordenados por precio
        $plans = Plan::orderBy('price_usd')->get();

        // 2) Obtener la tasa USD→CLP en tiempo real (fallback null)
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');
        $rate = $response->json('rates.CLP', null);

        return view('pricing', compact('plans', 'rate'));
    }
}
