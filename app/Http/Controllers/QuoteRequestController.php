<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Services\QuoteRequestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class QuoteRequestController extends Controller
{
    public function store(StoreQuoteRequest $request, QuoteRequestService $service): RedirectResponse
    {
        try {
            $quote = $service->create($request->validated(), $request->file('photos', []), $request->ip(), $request->userAgent());
        } catch (Throwable $e) {
            Log::error('Quote request persistence failed', ['error' => $e->getMessage(), 'type' => $e::class]);
            return redirect(route('home').'#contact')->withInput($request->safe()->except(['photos', 'website', 'consent']))
                ->with('error', 'Sorry, we could not save your quote request. Please try again or contact us directly.');
        }
        return redirect(route('home').'#contact')->with('quote_success', ['reference' => $quote->reference]);
    }
}
