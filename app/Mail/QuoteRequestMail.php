<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quoteData;

    public function __construct($quoteData)
    {
        $this->quoteData = $quoteData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Quote Request: ' . $this->quoteData['service'],
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.quote-request',
        );
    }
}
