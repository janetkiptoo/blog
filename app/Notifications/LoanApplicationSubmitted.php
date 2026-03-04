<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoanApplicationSubmitted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $loan)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
  

     public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Loan Application Submitted')
            ->line('A new loan application has been submitted.')
            ->line('Student: ' . $this->loan->user->name)
            ->line('Amount: KES ' . number_format($this->loan->loan_amount, 2))
            ->action('View Application', url('/admin/loans/' . $this->loan->id));
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
     public function toArray($notifiable)
    {
        return [
            'loan_id' => $this->loan->id,
            'student' => $this->loan->user->name,
            'amount' => $this->loan->loan_amount,
            'type' => 'loan_application',
        ];
    }
}

