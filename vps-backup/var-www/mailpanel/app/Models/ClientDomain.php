<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\ClientLogin;


class ClientDomain extends Model
{
    use HasFactory;

    // (aquí ya debían estar los $fillable, etc.)
    protected $fillable = [
        'client_id',
        'domain',
        'verified',
    ];

    /**
     * Relación: Un ClientDomain (un dominio) pertenece a un Client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * (Ya tenías la relación con buzones/logins)
     */
    public function logins()
    {
        return $this->hasMany(ClientLogin::class, 'client_domain_id');
    }
}
