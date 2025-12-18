<?php

namespace App\Notifications;

use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventInvitation extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;
    protected $invitation;

    public function __construct(Event $event, Invitation $invitation)
    {
        $this->event = $event;
        $this->invitation = $invitation;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Undangan Event: ' . $this->event->judul_event)
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Anda telah diundang ke event berikut:')
            ->line('**' . $this->event->judul_event . '**')
            ->line('Jenis: ' . $this->event->jenis_event)
            ->line('Waktu: ' . $this->event->formatted_date)
            ->line('Lokasi: ' . $this->event->lokasi)
            ->line('Mode: ' . ucfirst($this->event->mode_event))
            ->line('Penyelenggara: ' . $this->event->creator->name)
            ->action('Lihat Detail Event', route('events.show', $this->event))
            ->line('Terima kasih telah menggunakan FILKOM Meet!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'event_id' => $this->event->id,
            'event_title' => $this->event->judul_event,
            'event_date' => $this->event->tanggal_mulai->toDateTimeString(),
            'creator_name' => $this->event->creator->name,
            'invitation_id' => $this->invitation->id,
        ];
    }
}