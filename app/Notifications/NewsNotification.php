<?php

namespace App\Notifications;

use App\Models\News;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;

class NewsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected News $news;

    /**
     * Create a new notification instance.
     */
    public function __construct(News $news)
    {
        $this->news = $news;
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
        // Obtener todos los correos únicos de usuarios
        $bcc = User::query()
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->distinct()
            ->pluck('email')
            ->toArray();

        $photoUrl = $this->news->photo_path ? Storage::url($this->news->photo_path) : null;

        $photoUrl = null;
        if ($this->news->photo_path) {
            $relativeUrl = Storage::url($this->news->photo_path);
            $photoUrl = URL::to($relativeUrl);
        }

        return (new MailMessage)
            ->bcc($bcc)
            ->subject('Noticia: '.$this->news->title)
            ->line('Estimado/a')
            ->greeting($this->news->title)
            ->line(new HtmlString($this->news->body))
            ->when($photoUrl, function ($mail) use ($photoUrl) {
                return $mail->line(new HtmlString('<img src="'.e($photoUrl).'" alt="Foto de la noticia" style="max-width:100%;height:auto;" />'));
            })
            ->when(! empty($this->news->link), function ($mail) {
                return $mail->action('Ver enlace', $this->news->link);
            })
            ->salutation('Gracias por ser parte de nuestra comunidad.');
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
