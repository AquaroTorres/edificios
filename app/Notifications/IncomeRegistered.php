<?php

namespace App\Notifications;

use App\Models\Income;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IncomeRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    protected Income $income;

    /**
     * Create a new notification instance.
     */
    public function __construct(Income $income)
    {
        $this->income = $income;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $pdf = $this->income->generatePdf()->output();

        return (new MailMessage)
            ->subject('Comprobante de pago registrado')
            ->greeting("Estimado/a {$notifiable->name},")
            ->line('Le informamos que hemos registrado su pago de cuota u otro concepto.')
            ->line('Adjunto encontrará el comprobante para su respaldo.')
            ->attachData($pdf, 'comprobante_pago_'.$this->income->id.'.pdf', [
                'mime' => 'application/pdf',
            ])
            ->line('Si tiene alguna consulta, no dude en contactarnos.')
            ->salutation('Atentamente, '.db_config('system.company_name', 'Nombre de compañia'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
