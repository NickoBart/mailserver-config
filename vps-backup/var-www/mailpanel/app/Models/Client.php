<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;   // ← IMPORTANTE
use Illuminate\Notifications\Notifiable;
use App\Models\ClientDomain;

class Client extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    // Los campos que puedes rellenar masivamente
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'expires_at',
    ];

    // Nunca mostrar esto en arrays / JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casteos simples
    protected $casts = [
        'email_verified_at' => 'datetime',
        'expires_at'        => 'datetime',
    ];

    public function domains()
    {
        return $this->hasMany(ClientDomain::class);
    }

    /**
     * Tickets creados por este cliente
     */
    public function tickets()
    {
        return $this->morphMany(\App\Models\Ticket::class, 'ticketable');
    }

    /**
     * Mensajes escritos por este cliente
     */
    public function ticketMessages()
    {
        return $this->morphMany(\App\Models\TicketMessage::class, 'author');
    }

}
