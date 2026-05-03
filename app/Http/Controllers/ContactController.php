<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteRequestMail;

class ContactController extends Controller
{
    public function submitQuote(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20', // Added Phone validation
            'service' => 'required|string',
            'message' => 'required|string|max:2000',
        ]);

        // 2. Send the email to the Admin
        Mail::to('info@touch2finish.co.uk')->send(new QuoteRequestMail($validated));

        // 3. Redirect back to the form with a success message
        return redirect('/#contact')->with('success', 'Thank you! Your quote request has been sent. We will be in touch shortly.');
    }
}
