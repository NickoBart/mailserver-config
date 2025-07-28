<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\TicketAttachment;
use App\Notifications\TicketCreated;
use App\Notifications\TicketReplied;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = Auth::user()
                       ->tickets()
                       ->withCount('messages')
                       ->latest()
                       ->get(); // ya no paginamos

        return view('support.client.index', compact('tickets'));
    }

    public function create()
    {
        return view('support.client.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject'          => 'required|string|max:255',
            'initial_message'  => 'required|string',
            'attachments.*'    => 'file|max:10240|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,txt,zip',
        ]);

        // Crear ticket
        $ticket = Auth::user()->tickets()->create([
            'subject'         => $data['subject'],
            'initial_message' => $data['initial_message'],
        ]);

        // Mensaje inicial
        $message = new TicketMessage([
            'message' => $data['initial_message'],
        ]);
        $message->author()->associate(Auth::user());
        $ticket->messages()->save($message);

        // Adjuntos del mensaje inicial
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('ticket_attachments', 'public');
                $message->attachments()->create([
                    'filename' => $file->getClientOriginalName(),
                    'filepath' => $path,
                ]);
            }
        }

        // Notificación
        Notification::route('mail', [
            'ndonoso.partner7@gmail.com',
            'soporte@connectia.info',
        ])->notify(new TicketCreated($ticket));

        return redirect()
               ->route('support.tickets.show', $ticket)
               ->with('success','Ticket creado correctamente.');
    }

    public function show(Ticket $ticket)
    {
        abort_unless($ticket->ticketable->is(Auth::user()), 403);

        $messages = $ticket->messages()->with('author','attachments')->get();

        return view('support.client.show', compact('ticket','messages'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        abort_unless($ticket->ticketable->is(Auth::user()), 403);

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

        Notification::route('mail', [
            'ndonoso.partner7@gmail.com',
            'soporte@connectia.info',
        ])->notify(new TicketReplied($ticket, $message));

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
