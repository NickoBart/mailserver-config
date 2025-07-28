<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class SetupController extends Controller
{
    /**
     * Muestra la guía de configuración DNS.
     */
    public function index()
    {
        return view('setup.index');
    }
}
