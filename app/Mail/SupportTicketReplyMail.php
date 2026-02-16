<?php

namespace App\Mail;

use App\Models\SupportTicket;
use App\Models\SupportReply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportTicketReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public SupportTicket $ticket;
    public SupportReply $reply;

    public function __construct(SupportTicket $ticket, SupportReply $reply)
    {
        $this->ticket = $ticket;
        $this->reply  = $reply;
    }

    public function build()
    {
        return $this->subject('Response to Your Support Ticket')
            ->view('emails.support.reply')
            ->with([
                'ticket' => $this->ticket,
                'reply'  => $this->reply,
            ]);
    }
}
