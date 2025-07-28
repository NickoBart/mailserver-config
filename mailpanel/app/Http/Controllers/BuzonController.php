<?php

namespace App\Http\Controllers;

use App\Models\ClientLogin as Buzon;
use App\Models\ClientDomain as Dominio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BuzonController extends Controller
{
    public function index()
    {
        return view('vendor.adminlte.pages.buzones.index');
    }

    public function datatables()
    {
        $userEmail  = auth()->user()->email;
        $userDomain = substr(strrchr($userEmail, "@"), 1);
        $dom = Dominio::where('domain', $userDomain)->first();

        if ($dom) {
            $buzonesQuery = Buzon::where('client_domain_id', $dom->id)
                                 ->select(['id', 'login', 'client_domain_id', 'created_at']);
        } else {
            $buzonesQuery = Buzon::whereRaw('0 = 1')
                                 ->select(['id', 'login', 'client_domain_id', 'created_at']);
        }

        return datatables()
            ->of($buzonesQuery)
            ->addColumn('local', function ($b) {
                return strstr($b->login, '@', true);
            })
            ->addColumn('dominio', function ($b) {
                return substr(strrchr($b->login, "@"), 1);
            })
            ->addColumn('creado', function ($b) {
                return $b->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('acciones', function ($b) {
                $editar = '<a href="'
                          . route('buzones.edit', ['buzone' => $b->id])
                          . '" class="btn btn-sm btn-primary mr-1">
                                 <i class="fas fa-edit"></i>
                             </a>';
                $eliminar = '<form method="POST" action="' . route('buzones.destroy', ['buzone' => $b->id]) . '" style="display:inline;">'
                          .    '<input type="hidden" name="_token" value="' . csrf_token() . '">'
                          .    '<input type="hidden" name="_method" value="DELETE">'
                          .    '<button type="submit" class="btn btn-sm btn-danger" '
                          .            'onclick="return confirm(\'¿Eliminar este buzón?\')">'
                          .        '<i class="fas fa-trash-alt"></i>'
                          .    '</button>'
                          . '</form>';

                return $editar . $eliminar;
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function create()
    {
        $userEmail  = auth()->user()->email;
        $userDomain = substr(strrchr($userEmail, "@"), 1);
        $dominios = Dominio::where('domain', $userDomain)
                           ->where('verified', 1)
                           ->orderBy('domain')
                           ->get();

        return view('vendor.adminlte.pages.buzones.create', compact('dominios'));
    }

    public function store(Request $request)
    {
        // 1) Validar “local”, “client_domain_id” y password
        $data = $request->validate([
            'local'            => 'required|string|max:255',
            'client_domain_id' => 'required|exists:client_domains,id',
            'password'         => 'required|string|min:6|confirmed',
        ]);

        // 2) Armar el login completo
        $dom = Dominio::findOrFail($data['client_domain_id']);
        $domainPart = $dom->domain;
        $login = $data['local'] . '@' . $domainPart;

        // 3) Validar unicidad en client_logins
        $request->merge(['login' => $login]);
        $request->validate([
            'login' => 'unique:client_logins,login',
        ]);

        // 4.a) Crear en mailserver.client_logins
        $nuevoBuzon = Buzon::create([
            'client_domain_id' => $data['client_domain_id'],
            'login'            => $login,
            'password'         => Hash::make($data['password']),
        ]);

        // 4.b) Insertar en postfixadmin.mailbox
        $md5pass = '{MD5}' . md5($data['password']);
        $maildir = $domainPart . '/' . $data['local'] . '/';

        DB::connection('postfix')->table('mailbox')->insert([
            'username'        => $login,
            'password'        => $md5pass,
            'name'            => $data['local'],
            'maildir'         => $maildir,
            'quota'           => 1024,
            'local_part'      => $data['local'],
            'domain'          => $domainPart,
            'created'         => now()->format('Y-m-d H:i:s'),
            'modified'        => now()->format('Y-m-d H:i:s'),
            'active'          => 1,
            'phone'           => '',
            'email_other'     => '',
            'token'           => '',
            'token_validity'  => '2000-01-01 00:00:00',
            'password_expiry' => '2000-01-01 00:00:00',
            'totp_secret'     => null,
            'smtp_active'     => 1,
        ]);

        return redirect()->route('buzones.index')
                         ->with('success', 'Buzón creado correctamente en ambas bases de datos.');
    }

    public function edit(Buzon $buzone)
    {
        $userEmail  = auth()->user()->email;
        $userDomain = substr(strrchr($userEmail, "@"), 1);
        $dominios = Dominio::where('domain', $userDomain)
                           ->where('verified', 1)
                           ->orderBy('domain')
                           ->get();

        // Le pasamos a la vista la clave 'buzon' apuntando a $buzone
        return view('vendor.adminlte.pages.buzones.edit', [
            'buzon'   => $buzone,
            'dominios'=> $dominios,
        ]);


    }

    public function update(Request $request, Buzon $buzone)
    {
        // 1) Validar “local”, “client_domain_id” y password (opcional)
        $data = $request->validate([
            'local'            => 'required|string|max:255',
            'client_domain_id' => 'required|exists:client_domains,id',
            'password'         => 'nullable|string|min:6|confirmed',
        ]);

        // 2) Armar nuevo login
        $dom = Dominio::findOrFail($data['client_domain_id']);
        $domainPart = $dom->domain;
        $newLogin   = $data['local'] . '@' . $domainPart;
        $oldLogin   = $buzone->login;

        // 3) Validar unicidad en client_logins (excluyendo la fila actual)
        $request->merge(['login' => $newLogin]);
        $request->validate([
            'login' => 'unique:client_logins,login,' . $buzone->id,
        ]);

        // 4.a) Actualizar en mailserver.client_logins
        $updateArray = [
            'client_domain_id' => $data['client_domain_id'],
            'login'            => $newLogin,
        ];
        if (!empty($data['password'])) {
            $updateArray['password'] = Hash::make($data['password']);
        }
        $buzone->update($updateArray);

        // 4.b) Actualizar en postfixadmin.mailbox
        if (!empty($data['password'])) {
            $md5pass = '{MD5}' . md5($data['password']);
            DB::connection('postfix')->table('mailbox')
              ->where('username', $oldLogin)
              ->update(['password' => $md5pass]);
        }

        $newMaildir = $domainPart . '/' . $data['local'] . '/';
        DB::connection('postfix')->table('mailbox')
          ->where('username', $oldLogin)
          ->update([
              'username'   => $newLogin,
              'local_part' => $data['local'],
              'domain'     => $domainPart,
              'maildir'    => $newMaildir,
              'modified'   => now()->format('Y-m-d H:i:s'),
          ]);

        return redirect()->route('buzones.index')
                         ->with('success', 'Buzón actualizado correctamente en ambas bases de datos.');
    }

    public function destroy(Buzon $buzone)
    {
        Log::info("destroy: ejecutando delete() para buzon id={$buzone->id}, login={$buzone->login}");

        // 5.a) Eliminar de postfixadmin.mailbox
        DB::connection('postfix')->table('mailbox')
          ->where('username', $buzone->login)
          ->delete();

        // 5.b) Eliminar de mailserver.client_logins
        $buzone->delete();

        return redirect()->route('buzones.index')
                         ->with('success', 'Buzón eliminado correctamente de ambas bases de datos.');
    }
}
