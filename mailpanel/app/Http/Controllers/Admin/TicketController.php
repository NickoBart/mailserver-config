<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\TicketAttachment;
use App\Notifications\TicketReplied;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('ticketable')
                         ->withCount('messages')
                         ->latest()
                         ->get(); // sin paginación

        return view('support.admin.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $messages = $ticket->messages()->with('author','attachments')->get();

        return view('support.admin.show', compact('ticket','messages'));
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $ticket->assigned_to = $data['assigned_to'];
        $ticket->save();

        return back()->with('success','Ticket asignado correctamente.');
    }

    public function update(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'status' => 'required|in:abierto,en_proceso,resuelto',
        ]);

        $ticket->status = $data['status'];
        $ticket->save();

        return back()->with('success','Estado actualizado correctamente.');
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $data = $request->validate([
            'message'         => 'required|string',
            'attachments.*'   => 'file|max:10240|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,txt,zip',
        ]);

        $message = new TicketMessage([
            'message' => $data['message'],
        ]);
        $message->author()->associate(Auth::user());
        $ticket->messages()->save($message);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('ticket_attachments', 'public');
                $message->attachments()->create([
                    'filename' => $file->getClientOriginalName(),
                    'filepath' => $path,
                ]);
            }
        }

        Notification::route('mail', $ticket->ticketable->email)
                    ->notify(new TicketReplied($ticket, $message));

        return back()->with('success','Respuesta enviada correctamente.');
    }

    /**
     * Elimina un adjunto de un mensaje
     */
    public function destroyAttachment(Ticket $ticket, TicketAttachment $attachment)
    {
        $this->authorize('delete', $attachment);

        Storage::disk('public')->delete($attachment->filepath);
        $attachment->delete();

        return back()->with('success','Adjunto eliminado.');
    }
}
