<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $client;
    protected $amount;
    protected $description;


    /**
     * Create a new message instance.
     */
    public function __construct(string $client, string $amount, string $description)
    {
        $this->client = $client;
        $this->amount = $amount;
        $this->description = $description;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificação - API Ingressos',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment',
            with: [
                'client' => $this->client,
                'amount' => $this->amount,
                'description' => $this->description,
            ],
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
