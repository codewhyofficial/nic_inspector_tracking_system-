<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;

    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Account Created Successfully',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.accountCreated',
        );
    }

    /**
     * Build the message.
     *
     * @return $this
     */

     public function attachments(): array
     {
        return [];
     }
}
