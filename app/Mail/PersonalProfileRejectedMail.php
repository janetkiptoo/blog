<?php

namespace App\Mail;

use App\Models\PersonalProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PersonalProfileRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public PersonalProfile $profile) {}

    public function build()
    {
        return $this
            ->subject('Your Personal Profile Was Rejected')
            ->view('emails.personal-profile.rejected');
    }

     /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Personal Profile Rejected Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }
}
