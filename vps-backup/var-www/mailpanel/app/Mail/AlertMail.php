<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mime\Email;

class AlertMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Lista de alertas a mostrar en el correo.
     *
     * @var array
     */
    public array $alerts;

    /**
     * Crea una nueva instancia del mensaje.
     *
     * @param  array  $alerts
     */
    public function __construct(array $alerts)
    {
        $this->alerts = $alerts;
    }

    /**
     * Construye el correo:
     * - Origen y reply-to unificados
     * - Asunto fijo
     * - Plantilla Markdown
     * - Cabecera List-Unsubscribe
     */
    public function build(): self
    {
        return $this
            ->from('soporte@connectia.info', 'Connectia Mail')
            ->replyTo('soporte@connectia.info', 'Connectia Mail')
            ->subject('Alertas de métricas de correo')
            ->markdown('emails.alert')
            ->with('alerts', $this->alerts)
            ->withSymfonyMessage(function (Email $message) {
                $message->getHeaders()
                        ->addTextHeader(
                            'List-Unsubscribe',
                            '<mailto:soporte@connectia.info?subject=Unsubscribe>'
                        );
            });
    }
}
