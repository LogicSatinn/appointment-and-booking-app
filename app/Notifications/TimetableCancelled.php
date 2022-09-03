<?php

namespace App\Notifications;

use App\Models\Timetable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TimetableCancelled extends Notification
{
    use Queueable;

    protected Timetable $timetable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Timetable $timetable)
    {
        $this->timetable = $timetable;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Timetable Cancelled.')
            ->greeting('Hello there.')
                    ->line('We are sorry to announce that '.$this->timetable->title.' on '.$this->timetable->from.' is cancelled until further notice.')
                    ->line('We deeply apologize for the inconvenience we may have caused.')
                    ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
