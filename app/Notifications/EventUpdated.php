<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventUpdated extends Notification implements ShouldQueue
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
            ->subject('Perubahan Event: ' . $this->event->judul_event)
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Event yang Anda ikuti telah mengalami perubahan:')
            ->line('**' . $this->event->judul_event . '**')
            ->line('Waktu: ' . $this->event->formatted_date)
            ->line('Lokasi: ' . $this->event->lokasi)
            ->action('Lihat Detail Event', route('events.show', $this->event))
            ->line('Mohon sesuaikan jadwal Anda. Terima kasih!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'event_id' => $this->event->id,
            'event_title' => $this->event->judul_event,
            'event_date' => $this->event->tanggal_mulai->toDateTimeString(),
        ];
    }
}