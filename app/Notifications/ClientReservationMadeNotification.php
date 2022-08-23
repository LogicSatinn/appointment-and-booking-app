<?php

namespace App\Notifications;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClientReservationMadeNotification extends Notification
{
    use Queueable;

    protected Reservation $reservation;

    protected Booking $booking;

    protected Client $client;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, Booking $booking, Client $client)
    {
        $this->reservation = $reservation;
        $this->booking = $booking;
        $this->client = $client;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Reservation Secured Successfully.')
                    ->greeting('Hello There, '.$this->client->name)
                    ->line('We are proud to tell you that your reservation of '.$this->reservation->no_of_seats.' seats has been successfully secured.')
                    ->line('Here\'s your Invoice Reference Code: '.$this->booking->reference_code.' . You\'ll use it to make further payments.')
                    ->line('Be informed that you may lose your seat(s) if you do not pay before six hours of the timetable.')
                    ->line('Thank you for using our services. Have a good day!');
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
