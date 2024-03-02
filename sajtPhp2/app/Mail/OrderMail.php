<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $subject;
    public $poruka;
    public $mail;
    public $products;
    public $data;
    public $total;


    public function __construct($user, $subject, $poruka, $mail, $products, $data, $total)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->poruka = $poruka;
        $this->mail = $mail;
        $this->products = $products;
        $this->data = $data;
        $this->total = $total;
    }




    /**
     * Get the message envelope.
     */
    public function envelope() : Envelope
    {
        return new Envelope(
            from: new Address($this->mail, 'Laptop Shop'),
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */


    public function content(): Content
    {

        return new Content(
            view: 'pages.main.ordermail',
            with: ['user' => $this->user, 'subject' => $this->subject, 'poruka' => $this->poruka, 'mail' => $this->mail, 'products' => $this->products, 'data' => $this->data, 'total' => $this->total],

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
