<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ClientDomain as Dominio;
use App\Models\ClientLogin;
use App\Models\Subscription;
use App\Models\Buzon;

class DominioController extends Controller
{
    /** 1) Mostrar vista principal de “Dominios” */
    public function index()
    {
        $user    = Auth::user();
        $isSuper = ($user->email === 'admin@connectia.info');

        return view('vendor.adminlte.pages.dominios.index', compact('isSuper'));
    }

    /** 2) JSON para DataTables (AJAX) */
    public function datatables()
    {
        $user    = Auth::user();
        $esSuper = ($user->email === 'admin@connectia.info');

        if ($esSuper) {
            $query = Dominio::with('client')
                            ->select(['id','client_id','domain','verified','created_at']);
        } else {
            $clienteId = $user->client->id;
            $query = Dominio::where('client_id', $clienteId)
                            ->with('client')
                            ->select(['id','client_id','domain','verified','created_at']);
        }

        return datatables()
            ->of($query)
            ->addColumn('cliente', function ($d) {
                return $d->client ? $d->client->email : '–';
            })
            ->addColumn('casillas', function ($d) {
                $sub = Subscription::where('domain', $d->domain)
                                   ->where('status', 'active')
                                   ->first();
                return $sub ? $sub->quantity : 0;
            })
            ->addColumn('buzones_usados', function ($d) {
                return Buzon::whereHas('dominio', function($q) use($d) {
                            $q->where('nombre', $d->domain);
                        })->count();
            })
            ->addColumn('vencimiento', function ($d) {
                $sub = Subscription::where('domain', $d->domain)
                                   ->where('status', 'active')
                                   ->first();
                return $sub && $sub->expires_at
                    ? $sub->expires_at->format('d/m/Y H:i')
                    : '–';
            })
            ->addColumn('estado', function ($d) {
                return $d->verified ? 'Verificado' : 'Pendiente';
            })
            ->addColumn('acciones', function ($d) use ($user) {
                $editBtn = '<a href="'.route('dominios.edit',['dominio'=>$d->id]).'" class="btn btn-sm btn-primary me-1"><i class="fas fa-edit"></i></a>';
                $deleteForm = '<form method="POST" action="'.route('dominios.destroy',['dominio'=>$d->id]).'" style="display:inline;">'
                            . csrf_field()
                            . method_field('DELETE')
                            . '<button type="submit" class="btn btn-sm btn-danger me-1" onclick="return confirm(\'¿Eliminar este dominio?\')">'
                            . '<i class="fas fa-trash-alt"></i></button></form>';
                $revalidateForm = '<form method="POST" action="'.route('dominios.revalidate',['dominio'=>$d->id]).'" style="display:inline;">'
                                . csrf_field()
                                . '<button type="submit" class="btn btn-sm btn-success me-1" title="Revalidar DNS" onclick="return confirm(\'¿Revalidar DNS?\')">'
                                . '<i class="fas fa-sync-alt"></i></button></form>';
                $manual = '<a href="'.route('dominios.renewManualForm',['dominio'=>$d->id]).'" class="btn btn-sm btn-warning me-1" title="Renovar Manual">'
                        . '<i class="fas fa-calendar-alt"></i></a>';

                return $editBtn . $deleteForm . $revalidateForm . $manual;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    /** 3) Mostrar formulario para crear nuevo dominio */
    public function create()
    {
        $user    = Auth::user();
        $isSuper = ($user->email === 'admin@connectia.info');
        $clientes = $isSuper
            ? \App\Models\Client::select(['id','email'])->orderBy('email')->get()
            : [];

        return view('vendor.adminlte.pages.dominios.create', compact('isSuper','clientes'));
    }

    /** 4) Guardar dominio nuevo */
    public function store(Request $request)
    {
        $user    = Auth::user();
        $isSuper = ($user->email === 'admin@connectia.info');
        $rules   = ['domain' => 'required|string|unique:client_domains,domain|regex:/^[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/'];

        if ($isSuper) {
            $rules['client_id'] = 'required|exists:clients,id';
        }

        $data = $request->validate($rules);
        $nuevoDomain = strtolower(trim($data['domain'], "/ "));

        $dominio = $isSuper
            ? Dominio::create(['client_id' => $data['client_id'], 'domain' => $nuevoDomain, 'verified' => 1])
            : Dominio::create(['client_id' => $user->client->id, 'domain' => $nuevoDomain, 'verified' => 0]);

        DB::connection('postfix')->table('domain')->insert([
            'domain'          => $nuevoDomain,
            'description'     => '',
            'aliases'         => 0,
            'mailboxes'       => 0,
            'maxquota'        => 0,
            'quota'           => 0,
            'transport'       => 'virtual',
            'backupmx'        => 0,
            'active'          => 1,
            'created'         => now(),
            'modified'        => now(),
            'password_expiry' => 0,
        ]);

        return redirect()->route('dominios.index')
                         ->with('success','Dominio creado correctamente.');
    }

    /** 5) Mostrar formulario para editar un dominio */
    public function edit(Dominio $dominio)
    {
        $user    = Auth::user();
        $isSuper = ($user->email === 'admin@connectia.info');

        if (! $isSuper && $dominio->client_id !== $user->client->id) {
            abort(403);
        }

        $clientes = $isSuper
            ? \App\Models\Client::select(['id','email'])->orderBy('email')->get()
            : [];

        return view('vendor.adminlte.pages.dominios.edit', compact('dominio','isSuper','clientes'));
    }

    /** 6) Actualizar dominio */
    public function update(Request $request, Dominio $dominio)
    {
        $user    = Auth::user();
        $isSuper = ($user->email === 'admin@connectia.info');

        if (! $isSuper && $dominio->client_id !== $user->client->id) {
            abort(403);
        }

        $rules = [
            'domain'   => 'required|string|unique:client_domains,domain,'.$dominio->id.'|regex:/^[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,}$/',
            'verified' => 'sometimes|boolean',
        ];

        if ($isSuper) {
            $rules['client_id'] = 'required|exists:clients,id';
        }

        $data = $request->validate($rules);

        $oldDomain = $dominio->domain;
        $newDomain = strtolower(trim($data['domain'], "/ "));

        if ($isSuper) {
            $dominio->client_id = $data['client_id'];
        }

        $dominio->update([
            'domain'   => $newDomain,
            'verified' => $data['verified'] ?? $dominio->verified,
        ]);

        DB::connection('postfix')->table('domain')
          ->where('domain',$oldDomain)
          ->update(['domain'=>$newDomain,'modified'=>now()]);

        return redirect()->route('dominios.index')
                         ->with('success','Dominio actualizado correctamente.');
    }

    /** 7) Eliminar dominio y buzones asociados */
    public function destroy(Dominio $dominio)
    {
        $user = Auth::user();

        if ($user->email !== 'admin@connectia.info' && $dominio->client_id !== $user->client->id) {
            abort(403);
        }

        foreach ($dominio->logins as $b) {
            DB::connection('postfix')->table('mailbox')
              ->where('username',$b->login)
              ->delete();
        }

        ClientLogin::where('client_domain_id',$dominio->id)->delete();

        DB::connection('postfix')->table('domain')
          ->where('domain',$dominio->domain)
          ->delete();

        $dominio->delete();

        return redirect()->route('dominios.index')
                         ->with('success','Dominio eliminado correctamente.');
    }

    /** 8) Revalidar DNS */
    public function revalidate(Dominio $dominio)
    {
        $user = Auth::user();

        if ($user->email !== 'admin@connectia.info' && $dominio->client_id !== $user->client->id) {
            abort(403);
        }

        (new \App\Services\DomainDnsValidator($dominio))->validate();

        return back()->with('success','Validación DNS actualizada.');
    }

    /**
     * 9) Formulario de renovación manual
     */
    public function renewManualForm(Dominio $dominio)
    {
        // Buscamos la suscripción activa
        $sub = Subscription::where('domain', $dominio->domain)
                           ->where('status', 'active')
                           ->first();

        return view('vendor.adminlte.pages.dominios.renew-manual', compact('dominio','sub'));
    }

    /** 10) Procesar renovación manual */
    public function renewManual(Request $request, Dominio $dominio)
    {
        $data = $request->validate([
            'expires_at' => 'required|date',
        ]);

        $expires = Carbon::parse($data['expires_at'])->endOfDay();

        // Buscar suscripción activa existente
        $sub = Subscription::where('domain', $dominio->domain)
                           ->where('status', 'active')
                           ->first();

        if ($sub) {
            // Si existe, actualizamos sólo la fecha
            $sub->expires_at = $expires;
            $sub->save();
        } else {
            // Si no existe, creamos una nueva suscripción activa
            $cliente = $dominio->client;

            Subscription::create([
                'name'           => $cliente->name,
                'email'          => $cliente->email,
                'domain'         => $dominio->domain,
                'status'         => 'active',
                'expires_at'     => $expires,

                'razon_social'   => '',
                'rut'            => '',
                'direccion'      => '',
                'ciudad_region'  => '',
                'giro'           => '',
            ]);
        }

        return redirect()
            ->route('dominios.index')
            ->with('success', "Suscripción de {$dominio->domain} renovada hasta {$expires->format('Y-m-d')}");
    }
}
