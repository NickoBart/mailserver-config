<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientLogin extends Model
{
    use HasFactory;

    // La tabla real que vamos a usar:
    protected $table = 'client_logins';

    // Columnas “fillable” que usaremos al crear/editar un buzón:
    protected $fillable = [
        'client_domain_id',
        'login',    // correo electrónico
        'maildir',  // opcional, si en el futuro quieres asignar ruta; por ahora lo dejamos null
        'password',    // <— agregamos password
    ];

    // No hay columna “password” ni “status” aquí, así que no las listamos.
    protected $hidden = [
        'password',
    ];

    // Relación: cada buzón (client_login) pertenece a un dominio (client_domain):
    public function domain()
    {
        return $this->belongsTo(ClientDomain::class, 'client_domain_id');
    }
}
