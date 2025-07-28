<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // 1) Verificación de cuotas de buzones cada hora
        $schedule->job(new \App\Jobs\CheckMailboxQuotas)
                 ->hourly();

        // 2) Recordatorio de 7 días antes
        $schedule->job(new \App\Jobs\SendExpiryReminders(7))
                 ->dailyAt('09:00')
                 ->name('billing.reminder.7days');

        // 3) Recordatorio de 3 días antes
        $schedule->job(new \App\Jobs\SendExpiryReminders(3))
                 ->dailyAt('09:00')
                 ->name('billing.reminder.3days');

        // 4) Recordatorio de 2 días antes
        $schedule->job(new \App\Jobs\SendExpiryReminders(2))
                 ->dailyAt('09:00')
                 ->name('billing.reminder.2days');

        // 5) Recordatorio de 1 día antes
        $schedule->job(new \App\Jobs\SendExpiryReminders(1))
                 ->dailyAt('09:00')
                 ->name('billing.reminder.1day');

        // 6) Comando de expiración definitiva a medianoche
        $schedule->command('expire:subscriptions')
                 ->dailyAt('00:00')
                 ->name('billing.expire.subscriptions');

        // 7) Aviso de prórroga: 3 días antes de que termine la prórroga
        $schedule->job(new \App\Jobs\SendGraceReminders(3))
                 ->dailyAt('09:00')
                 ->name('billing.grace.3days');

        // 8) Aviso de prórroga: 2 días antes
        $schedule->job(new \App\Jobs\SendGraceReminders(2))
                 ->dailyAt('09:00')
                 ->name('billing.grace.2days');

        // 9) Aviso de prórroga: 1 día antes
        $schedule->job(new \App\Jobs\SendGraceReminders(1))
                 ->dailyAt('09:00')
                 ->name('billing.grace.1day');

        $schedule->command('mail:check-metrics')
                 ->dailyAt('08:00')
                 ->description('Chequea métricas de correo y envía alertas');

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    protected $commands = [
        \App\Console\Commands\CheckMailMetrics::class,
    ];

}
