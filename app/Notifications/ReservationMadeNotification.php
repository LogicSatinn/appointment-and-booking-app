<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationMadeNotification extends Notification
{
    use Queueable;

    protected $clientAppointment;
    protected $booking;
    protected $payment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($clientAppointment, $booking, $payment)
    {
        $this->clientAppointment = $clientAppointment;
        $this->booking = $booking;
        $this->payment = $payment;
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
                    ->subject('Reservation Secured Successfully.')
                    ->greeting('Hello There, ' . $this->clientAppointment->name)
                    ->line('We are proud to tell you that you\'re reservation of ' . $this->clientAppointment->pivot->no_of_seats . ' seats has been successfully secured.')
                    ->line('Here\'s your Invoice Reference Code: ' . $this->booking->reference_code)
                    ->line('And here\'s your Payment Reference Code: ' . $this->payment->reference_code . ' . You\'ll use it to make further payments.')
                    ->line('Be informed that you may lose your seat if you do not pay before six hours of the appointment.')
//                    ->action('Notification Action', url('/'))
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
