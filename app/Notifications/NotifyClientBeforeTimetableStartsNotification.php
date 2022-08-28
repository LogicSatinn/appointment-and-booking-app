<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyClientBeforeTimetableStartsNotification extends Notification
{
    private string $reservation_reference_code;
    private string $booking_reference_code;
    private string $title;

    public function __construct($reservation_reference_code, $booking_reference_code, $title)
    {
        $this->reservation_reference_code = $reservation_reference_code;
        $this->booking_reference_code = $booking_reference_code;
        $this->title = $title;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello There')
            ->subject($this->title . ' Starts In Two Days.')
            ->line('Save the date because ' . $this->title . ' starts in two days and we are beyond excited to see you there.')
            ->line('This is your Reservation Reference: ' . $this->reservation_reference_code)
            ->line('This is your Booking Reference: ' . $this->booking_reference_code)
            ->line('Thank you. Have a good one.');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
