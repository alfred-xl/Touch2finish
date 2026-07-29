<?php

namespace App\Jobs;

use App\Mail\QuoteRequestMail;
use App\Mail\QuoteRequestReceivedMail;
use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendQuoteRequestNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public int $tries = 3;
    public int $timeout = 120;
    public function __construct(public QuoteRequest $quoteRequest) {}
    public function handle(): void
    {
        $quote = $this->quoteRequest->fresh()->load('attachments');
        try {
            Mail::to(config('mail.contact_receiver'))->send(new QuoteRequestMail($quote));
            $quote->update(['notification_status' => 'sent', 'notification_error' => null]);
        } catch (Throwable $e) {
            $quote->update(['notification_status' => 'failed', 'notification_error' => 'Internal notification delivery failed ('.class_basename($e).').']);
            Log::error('Quote internal notification failed', ['reference' => $quote->reference, 'error' => $e->getMessage(), 'notification_type' => 'internal']);
        }
        try {
            Mail::to($quote->email)->send(new QuoteRequestReceivedMail($quote));
        } catch (Throwable $e) {
            Log::error('Quote customer acknowledgement failed', ['reference' => $quote->reference, 'error' => $e->getMessage(), 'notification_type' => 'customer']);
        }
    }
}
