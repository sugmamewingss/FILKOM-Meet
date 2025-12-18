<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventCancelled extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pembatalan Event: ' . $this->event->judul_event)
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Event berikut telah dibatalkan:')
            ->line('**' . $this->event->judul_event . '**')
            ->line('Waktu yang dijadwalkan: ' . $this->event->formatted_date)
            ->line('Penyelenggara: ' . $this->event->creator->name)
            ->line('Mohon maaf atas ketidaknyamanannya.')
            ->line('Terima kasih atas pengertiannya!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'event_id' => $this->event->id,
            'event_title' => $this->event->judul_event,
            'cancelled_at' => now()->toDateTimeString(),
        ];
    }
}