<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class QuoteRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public QuoteRequest $quoteRequest) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->quoteRequest->email, $this->quoteRequest->name)],
            subject: "New Quote Request {$this->quoteRequest->reference} - {$this->quoteRequest->service_title}",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.quote-request');
    }

    public function attachments(): array
    {
        return $this->quoteRequest->attachments->filter(function ($file) {
            if (Storage::disk($file->disk)->exists($file->stored_path)) {
                return true;
            }

            Log::warning('Quote mail attachment is missing', [
                'reference' => $this->quoteRequest->reference,
                'disk' => $file->disk,
                'path' => $file->stored_path,
            ]);

            return false;
        })->map(fn ($file) => Attachment::fromStorageDisk($file->disk, $file->stored_path)
            ->as(basename($file->original_name))
            ->withMime($file->mime_type))->values()->all();
    }
}
