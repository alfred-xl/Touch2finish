<?php

namespace App\Services;

use App\Jobs\SendQuoteRequestNotifications;
use App\Models\QuoteRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class QuoteRequestService
{
    public function create(array $data, array $files, ?string $ip, ?string $userAgent): QuoteRequest
    {
        $storedPaths = [];
        try {
            $quote = DB::transaction(function () use ($data, $files, $ip, $userAgent, &$storedPaths) {
                $reference = $this->uniqueReference();
                $service = config("touch2finish.services.{$data['service']}");
                $quote = QuoteRequest::create([
                    'reference' => $reference, 'name' => $data['name'], 'email' => $data['email'],
                    'phone' => $data['phone'], 'postcode' => $data['postcode'], 'service_slug' => $data['service'],
                    'service_title' => $service['title'] ?? config('touch2finish.quote_form.combined_title'),
                    'preferred_date' => $data['preferred_date'] ?? null,
                    'preferred_contact_method' => $data['preferred_contact_method'], 'message' => $data['message'],
                    'service_details' => $this->serviceDetails($data), 'consent_at' => now(),
                    'ip_address' => $ip, 'user_agent' => $userAgent,
                ]);
                foreach ($files as $file) $this->storeAttachment($quote, $file, $storedPaths);
                return $quote;
            });
        } catch (Throwable $e) {
            foreach ($storedPaths as [$disk, $path]) Storage::disk($disk)->delete($path);
            throw $e;
        }

        try {
            SendQuoteRequestNotifications::dispatch($quote)->afterCommit();
        } catch (Throwable $e) {
            Log::error('Quote notification job dispatch failed', ['reference' => $quote->reference, 'error' => $e->getMessage()]);
        }
        return $quote->load('attachments');
    }

    private function uniqueReference(): string
    {
        for ($attempt = 0; $attempt < 20; $attempt++) {
            $reference = 'T2F-'.now()->format('Ymd').'-'.Str::upper(Str::random(6));
            if (! QuoteRequest::where('reference', $reference)->exists()) return $reference;
        }
        throw new RuntimeException('Unable to generate a unique quote reference.');
    }

    private function serviceDetails(array $data): ?array
    {
        $fields = config("touch2finish.quote_form.detail_fields.{$data['service']}", []);
        $details = array_filter(array_intersect_key($data, array_flip($fields)), fn ($value) => $value !== null && $value !== '' && $value !== []);
        return $details ?: null;
    }

    private function storeAttachment(QuoteRequest $quote, UploadedFile $file, array &$storedPaths): void
    {
        $disk = 'local'; $path = "quote-requests/{$quote->reference}";
        $stored = $file->storeAs($path, Str::uuid().'.'.$file->extension(), $disk);
        if (! $stored) throw new RuntimeException('A photograph could not be stored.');
        $storedPaths[] = [$disk, $stored];
        $quote->attachments()->create(['original_name' => basename($file->getClientOriginalName()), 'stored_path' => $stored,
            'disk' => $disk, 'mime_type' => $file->getMimeType() ?: 'application/octet-stream', 'file_size' => $file->getSize()]);
    }
}
