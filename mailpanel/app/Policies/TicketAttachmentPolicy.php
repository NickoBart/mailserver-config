<?php

namespace App\Policies;

use App\Models\TicketAttachment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketAttachmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any attachments.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the attachment.
     */
    public function view(User $user, TicketAttachment $attachment): bool
    {
        // Superadmin ve todos
        if ($user->email === 'admin@connectia.info') {
            return true;
        }

        // El cliente propietario del ticket ve sus adjuntos
        return $attachment->message->ticket->ticketable_type === get_class($user)
            && $attachment->message->ticket->ticketable_id === $user->id;
    }

    /**
     * Determine whether the user can create attachments.
     */
    public function create(User $user): bool
    {
        // Cualquier usuario autenticado puede subir adjuntos a sus tickets
        return true;
    }

    /**
     * Determine whether the user can delete the attachment.
     */
    public function delete(User $user, TicketAttachment $attachment): bool
    {
        // Superadmin puede borrar cualquiera
        if ($user->email === 'admin@connectia.info') {
            return true;
        }

        // El cliente propietario del ticket puede borrar sus propios adjuntos
        return $attachment->message->ticket->ticketable_type === get_class($user)
            && $attachment->message->ticket->ticketable_id === $user->id;
    }

    /**
     * Otros métodos quedan deshabilitados.
     */
    public function update(User $user, TicketAttachment $attachment): bool
    {
        return false;
    }

    public function restore(User $user, TicketAttachment $attachment): bool
    {
        return false;
    }

    public function forceDelete(User $user, TicketAttachment $attachment): bool
    {
        return false;
    }
}
