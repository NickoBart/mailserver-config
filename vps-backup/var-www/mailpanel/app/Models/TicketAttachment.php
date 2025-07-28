<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_message_id',
        'filename',
        'filepath',
    ];

    /**
     * El mensaje al que pertenece este adjunto
     */
    public function message()
    {
        return $this->belongsTo(TicketMessage::class, 'ticket_message_id');
    }
}
