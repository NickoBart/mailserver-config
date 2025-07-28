<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Mostrar la página de inicio pública.
     */
    public function index()
    {
        return view('checkout');
    }
}
