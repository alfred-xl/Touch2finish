<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class QuoteRequestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public array $quoteData;

    public function __construct(array $quoteData)
    {
        $this->quoteData = $quoteData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [
                new Address($this->quoteData['email'], $this->quoteData['name']),
            ],
            subject: '🔔 New Quote Request — ' . $this->quoteData['service'] . ' | Touch2finish',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.quote-request',
            with: [
                'quoteData' => $this->quoteData,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
