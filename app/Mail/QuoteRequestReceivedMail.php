<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteRequestReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public QuoteRequest $quoteRequest) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: "We received your Touch2finish quote request - {$this->quoteRequest->reference}");
    }

    public function content(): Content
    {
        return new Content(view: 'emails.quote-request-received');
    }

    public function attachments(): array
    {
        return [];
    }
}
