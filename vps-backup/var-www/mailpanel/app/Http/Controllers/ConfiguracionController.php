<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('vendor.adminlte.pages.configuracion.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key'   => 'required|string|unique:settings,key',
            'value' => 'nullable|string',
        ]);

        Setting::create($data);

        return redirect()->route('configuracion.index')
                         ->with('success','Parámetro agregado correctamente.');
    }

    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            'value' => 'nullable|string',
        ]);

        $setting->update($data);

        return redirect()->route('configuracion.index')
                         ->with('success','Parámetro actualizado correctamente.');
    }
}
