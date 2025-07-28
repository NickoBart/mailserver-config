<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\ClientDomain;

class MailboxController extends Controller
{
    protected function getCurrentClient()
    {
        $user = Auth::user();

        // Si el user tiene client asociado, lo devolvemos
        if ($user->client) {
            return $user->client;
        }

        // Si es admin@dominio, extraemos el host y buscamos el ClientDomain
        [, $host] = explode('@', $user->email, 2);
        $cd = ClientDomain::where('domain', $host)->firstOrFail();
        return $cd->client;
    }

    public function index()
    {
        // 1) Dominios del cliente (solo host)
        $domains = collect($this->getCurrentClient()->domains()->pluck('domain')->toArray())
            ->map(fn($u) => parse_url($u, PHP_URL_HOST) ?: $u)
            ->toArray();

        // 2) Traer buzones de PostfixAdmin
        $mailboxes = DB::connection('postfix')
            ->table('mailbox')
            ->whereIn('domain', $domains)
            ->paginate(10);

        return view('mailboxes.index', compact('mailboxes'));
    }

    public function create()
    {
        // Dominios para el dropdown
        $domains = collect($this->getCurrentClient()->domains()->pluck('domain')->toArray())
            ->map(fn($u) => parse_url($u, PHP_URL_HOST) ?: $u)
            ->toArray();

        return view('mailboxes.create', compact('domains'));
    }

    public function store(Request $request)
    {
        // 1) Dominios válidos (solo host)
        $validDomains = collect($this->getCurrentClient()->domains()->pluck('domain')->toArray())
            ->map(fn($u) => parse_url($u, PHP_URL_HOST) ?: $u)
            ->toArray();

        // 2) Validar entrada
        $request->validate([
            'local_part' => ['required','regex:/^[a-z0-9._-]+$/i'],
            'domain'     => ['required', Rule::in($validDomains)],
            'password'   => 'required|min:6',
            'quota'      => 'required|integer|min:0',
        ], [
            'domain.in' => 'Dominio inválido.',
        ]);

        // 3) Preparar datos para PostfixAdmin
        $local    = $request->local_part;
        $domain   = $request->domain;
        $username = "{$local}@{$domain}";
        $maildir  = "{$domain}/{$local}/";
        $pwHash   = '{MD5}'.md5($request->password);

        // 4) Insertar en PostfixAdmin
        DB::connection('postfix')->table('mailbox')->insert([
            'username'     => $username,
            'password'     => $pwHash,
            'name'         => $local,
            'maildir'      => $maildir,
            'quota'        => $request->quota,
            'local_part'   => $local,
            'domain'       => $domain,
            'created'      => now(),
            'modified'     => now(),
            'active'       => 1,
            'smtp_active'  => 1,
        ]);

        return redirect()->route('mailboxes.index')
                         ->with('success','Buzón creado correctamente.');
    }

    public function edit(string $username)
    {
        $mb = DB::connection('postfix')->table('mailbox')
                 ->where('username',$username)
                 ->firstOrFail();

        $domains = collect($this->getCurrentClient()->domains()->pluck('domain')->toArray())
            ->map(fn($u) => parse_url($u, PHP_URL_HOST) ?: $u)
            ->toArray();

        [$local, $dom] = explode('@',$mb->username,2);

        return view('mailboxes.edit',compact('mb','domains','local','dom'));
    }

    public function update(Request $request, string $username)
    {
        // Asegurar que el buzón exista
        DB::connection('postfix')->table('mailbox')
          ->where('username',$username)
          ->firstOrFail();

        // Dominios válidos
        $validDomains = collect($this->getCurrentClient()->domains()->pluck('domain')->toArray())
            ->map(fn($u) => parse_url($u, PHP_URL_HOST) ?: $u)
            ->toArray();

        // Validar
        $request->validate([
            'password' => 'nullable|min:6',
            'quota'    => 'required|integer|min:0',
            'domain'   => ['required', Rule::in($validDomains)],
        ], [
            'domain.in' => 'Dominio inválido.',
        ]);

        // Campos a actualizar
        $updates = [
            'maildir'  => "{$request->domain}/{$request->local_part}/",
            'quota'    => $request->quota,
            'domain'   => $request->domain,
            'modified' => now(),
        ];
        if ($request->filled('password')) {
            $updates['password'] = '{MD5}'.md5($request->password);
        }

        DB::connection('postfix')->table('mailbox')
          ->where('username',$username)
          ->update($updates);

        return redirect()->route('mailboxes.index')
                         ->with('success','Buzón actualizado correctamente.');
    }

    public function destroy(string $username)
    {
        DB::connection('postfix')->table('mailbox')
          ->where('username',$username)
          ->delete();

        return redirect()->route('mailboxes.index')
                         ->with('success','Buzón eliminado correctamente.');
    }
}
