<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject;
    public $poruka;
    public $mail;

    public function __construct($user, $subject, $poruka, $mail)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->poruka = $poruka;
        $this->mail = $mail;
    }


    /**
     * Get the message envelope.
     */
    public function envelope() : Envelope
    {
        return new Envelope(
            from: new Address($this->mail, $this->user),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */


    public function content(): Content
    {

        return new Content(
            view: 'pages.main.mail',
            with: ['user' => $this->user, 'subject' => $this->subject, 'poruka' => $this->poruka, 'mail' => $this->mail],

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
