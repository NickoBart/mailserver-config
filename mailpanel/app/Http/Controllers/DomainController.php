<?php

namespace App\Http\Controllers;

use App\Models\ClientDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\DomainDnsValidator;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();
        $client = $user->client;
        if (! $client) {
            $parts  = explode("@", $user->email);
            $domain = end($parts);
            $cd     = ClientDomain::where("domain", $domain)->first();
            $client = $cd?->client;
        }
        if (! $client) {
            $domains = collect();
        } else {
            $domains = $client->domains()->latest()->paginate(10);
        }
        return view('domains.index', compact('domains'));
    }

    public function create()
    {
        //
        $clientId = auth()->user()->client->id;

        // Si ya tiene dominios, lo enviamos al índice en lugar de mostrar el form
        if (ClientDomain::where('client_id', $clientId)->exists()) {
            return redirect()->route('domains.index');
        }

        return view('domains.create');
    }


    public function store(Request $request)
    {
        // 1) Validar solo el nombre de dominio sin esquema
        $request->validate([
            'domain' => [
                'required',
                'regex:/^([a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z]{2,}$/i',
                'unique:client_domains,domain'
            ],
        ]);

        // 2) Normalizar añadiendo https:// antes de guardar
        $normalized = 'https://' . $request->domain;

        // 3) Crear el registro
        $domain = Auth::user()->domains()->create([
            'domain'   => $normalized,
            'verified' => false,
        ]);

        // Validación DNS inmediata
        (new \App\Services\DomainDnsValidator($domain))->validate();

        // 4) Redirigir con mensaje
        return redirect()->route('domains.index')
                         ->with('success', 'Dominio agregado correctamente.');
}

    public function show(ClientDomain $clientDomain)
    {
        $domain = \App\Models\ClientDomain::with('logins')
                    ->where('domain', $requestedDomain)
                    ->firstOrFail();
        return view('domains.show', compact('domain'));

        //
    }

    public function edit(ClientDomain $clientDomain)
    {
        //
        $this->authorize('own', $clientDomain); // opcional, ver nota
        return view('domains.edit', ['domain' => $clientDomain]);
    }

    public function update(Request $request, ClientDomain $clientDomain)
    {
        //
        $this->authorize('own', $clientDomain);
        $request->validate([
            'domain' => "required|url|unique:client_domains,domain,{$clientDomain->id}",
        ]);

        $clientDomain->update(['domain' => $request->domain]);
        return redirect()->route('domains.index')
                         ->with('success', 'Dominio actualizado correctamente.');
    }

    public function destroy(ClientDomain $clientDomain)
    {
        //
        $this->authorize('own', $clientDomain);
        $clientDomain->delete();
        return back()->with('success', 'Dominio eliminado.');
    }

    public function revalidate(ClientDomain $clientDomain)
    {
//        $this->authorize('own', $clientDomain);
        (new \App\Services\DomainDnsValidator($clientDomain))->validate();
        return back()->with('success', 'Validación DNS actualizada.');
    }

}
