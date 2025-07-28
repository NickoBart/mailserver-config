<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Mail\SubscriptionExpired;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscription;

class ExpireSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expiración automática de suscripciones al pasar su fecha de vencimiento';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $expired = Subscription::where('status', 'active')
            ->where('expires_at', '<', $now)
            ->get();

        foreach ($expired as $sub) {
            // Marcar como cancelada
            $sub->update(['status' => 'cancelled']);

            // Enviar email de notificación de expiración
            Mail::to($sub->email)
                ->queue(new SubscriptionExpired($sub));

            $this->info("Expired subscription {$sub->id}");
        }

        return 0;
    }
}
