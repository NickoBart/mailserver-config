<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscription;
use App\Mail\GraceReminder;
use Illuminate\Support\Facades\Log;

class SendGraceReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $daysBefore;

    public function __construct(int $daysBefore)
    {
        $this->daysBefore = $daysBefore;
    }

    public function handle(): void
    {
        $targetDate = now()->addDays($this->daysBefore)->toDateString();

        Log::info("SendGraceReminders: buscando suscripciones para {$this->daysBefore} días antes");

        $subs = Subscription::whereDate('grace_until', $targetDate)->get();

        Log::info('SendGraceReminders: suscripciones encontradas', ['count' => $subs->count()]);

        foreach ($subs as $sub) {
            $to = array_filter([
                'soporte@connectia.info',
                'admin@' . $sub->domain,
                $sub->contact_email ?? $sub->email,               // usamos el email real del suscriptor
            ]);

            $to = array_unique(array_filter($to, fn($email) => ! empty($email)));

            Log::info('SendGraceReminders: encolando GraceReminder', [
                'subscription_id' => $sub->id,
                'to'              => $to,
            ]);

            Mail::to($to)
                ->queue(new GraceReminder($sub, $this->daysBefore));
        }
    }
}
