<?php

namespace App\Observers;

use App\Models\Client;
use App\Mail\WelcomeClient;
use Illuminate\Support\Facades\Mail;

class ClientObserver
{
    /**
     * Handle the Client "created" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function created(Client $client)
    {
        // Recupera la contraseña en claro guardada en sesión (seteada en el webhook)
        $plain = session('new_client_plain');

        // Envía el correo de bienvenida con las credenciales
        Mail::to($client->email)
            ->send(new WelcomeClient($client, $plain));
    }
}
