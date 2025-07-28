<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TicketMessage;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticketable_type',
        'ticketable_id',
        'subject',
        'initial_message',
        'status',
        'assigned_to',
    ];

    /**
     * Quién creó este ticket (User o Client)
     */
    public function ticketable()
    {
        return $this->morphTo();
    }

    /**
     * Usuario asignado para resolverlo
     */
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Todos los mensajes de este ticket
     */
    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}
