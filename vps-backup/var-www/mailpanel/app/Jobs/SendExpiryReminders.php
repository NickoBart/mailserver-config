<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendExpiryReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /** @var int Días antes del vencimiento para enviar el aviso */
    protected int $daysBefore;

     /**
      * Create a new job instance.
      *
      * @param int $daysBefore Días antes del vencimiento para avisar
      */
     public function __construct(int $daysBefore = 7)
     {
         $this->daysBefore = $daysBefore;
     }

    /**
     * Execute the job.
     */
    public function handle()
    {
         // Cuántos días antes queremos avisar (viene por constructor)
         $daysBefore = $this->daysBefore;


        $today      = now();
        $threshold  = $today->copy()->addDays($daysBefore);

        // 1) Obtener clientes cuyo expires_at esté entre hoy y el umbral
        $clients = \App\Models\Client::whereNotNull('expires_at')
            ->whereBetween('expires_at', [$today, $threshold])
            ->get();

        foreach ($clients as $client) {
            // 2) Disparar el correo (puede ir a la cola o send directo)
            \Illuminate\Support\Facades\Mail::to($client->email)
                ->queue(new \App\Mail\ExpiryReminder(
                    $client->name,
                    $client->expires_at
                ));
        }
    }





}
