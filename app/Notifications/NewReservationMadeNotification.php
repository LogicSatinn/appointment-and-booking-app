<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReservationMadeNotification extends Notification
{
    use Queueable;

    protected $timetable;
    protected $clientTimetable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($timetable, $clientTimetable)
    {
        $this->timetable = $timetable;
        $this->clientTimetable = $clientTimetable;
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
                    ->subject('New Reservation Made')
                    ->greeting('Howdy Admin.')
                    ->line('There is a new reservation made by a client moments ago.')
                    ->line('Details...')
                    ->line('-------------------------------------------------------------------')
                    ->line('Skill: ' . $this->timetable->skill->title)
                    ->line('Timetable Title: ' . $this->timetable->title)
                    ->line('Number of Seats: ' . $this->clientTimetable->pivot->no_of_seats)
                    ->line('Name of Client: ' . $this->clientTimetable->name)
                    ->line('Further details can be found in the application. Have a good day!');
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
