<!doctype html>
<html lang="en">
<body style="margin:0;background:#F7F9F8;font-family:Arial,sans-serif;color:#172C2B">
@php
    $business = config('touch2finish.business');
    $options = config('touch2finish.quote_form.options', []);
    $labels = [
        'vehicle_make_model' => 'Vehicle make and model',
        'vehicle_size' => 'Vehicle size',
        'vehicle_condition' => 'Vehicle condition',
        'water_available' => 'Water available',
        'electricity_available' => 'Electricity available',
        'property_type' => 'Property type',
        'bedrooms' => 'Bedrooms',
        'bathrooms' => 'Bathrooms',
        'cleaning_type' => 'Cleaning type',
        'occupancy_status' => 'Occupancy status',
        'collection_postcode' => 'Collection postcode',
        'delivery_postcode' => 'Delivery postcode',
        'property_size' => 'Move size',
        'floor_level' => 'Floor or access',
        'lift_available' => 'Lift available',
        'moving_date' => 'Moving date',
        'large_items' => 'Large, heavy or fragile items',
        'task_list' => 'Task list',
        'materials_available' => 'Materials available',
        'number_of_rooms' => 'Rooms or areas',
        'property_status' => 'Property status',
        'surface_condition' => 'Surface condition',
        'desired_finish' => 'Intended finish',
        'combined_services' => 'Services required',
        'combined_details' => 'How services should work together',
    ];
    $readable = function ($key, $value) use ($options) {
        if (is_array($value)) {
            return collect($value)
                ->map(fn ($item) => config("touch2finish.services.{$item}.title", $item))
                ->join(', ');
        }

        foreach ($options as $set) {
            if (isset($set[$value])) {
                return $set[$value];
            }
        }

        return $value;
    };
    $digits = preg_replace('/\D+/', '', $quoteRequest->phone);
    $safeWhatsapp = strlen($digits) >= 10 && strlen($digits) <= 15 ? $digits : null;
@endphp

<div style="max-width:680px;margin:0 auto;background:#FFFFFF">
    <div style="background:#03403F;color:#FFFFFF;padding:28px">
        <div style="color:#D9A323;font-weight:bold">{{ $business['name'] }}</div>
        <h1 style="margin:10px 0 4px;font-size:25px">New Quote Request</h1>
        <div>{{ $quoteRequest->reference }}</div>
    </div>

    <div style="padding:28px">
        <h2 style="font-size:18px;border-bottom:2px solid #D9A323;padding-bottom:8px">Customer details</h2>
        <p>
            <strong>Name:</strong> {{ $quoteRequest->name }}<br>
            <strong>Email:</strong> <a href="mailto:{{ $quoteRequest->email }}">{{ $quoteRequest->email }}</a><br>
            <strong>Phone:</strong> {{ $quoteRequest->phone }}<br>
            <strong>Postcode:</strong> {{ $quoteRequest->postcode }}<br>
            <strong>Preferred contact:</strong> {{ config('touch2finish.quote_form.preferred_contact_methods.'.$quoteRequest->preferred_contact_method) }}
        </p>

        <h2 style="font-size:18px;border-bottom:2px solid #D9A323;padding-bottom:8px">Service details</h2>
        <p>
            <strong>Service:</strong> {{ $quoteRequest->service_title }}
            @if ($quoteRequest->preferred_date)
                <br><strong>Preferred date:</strong> {{ $quoteRequest->preferred_date->format('j F Y') }}
            @endif
        </p>

        @if ($quoteRequest->service_details)
            <table style="width:100%;border-collapse:collapse">
                @foreach ($quoteRequest->service_details as $key => $value)
                    <tr>
                        <td style="padding:7px;border-bottom:1px solid #ddd">
                            <strong>{{ $labels[$key] ?? ucfirst(str_replace('_', ' ', $key)) }}</strong>
                        </td>
                        <td style="padding:7px;border-bottom:1px solid #ddd">{{ $readable($key, $value) }}</td>
                    </tr>
                @endforeach
            </table>
        @endif

        <h2 style="font-size:18px;border-bottom:2px solid #D9A323;padding-bottom:8px">Customer message</h2>
        <p style="white-space:pre-wrap">{{ $quoteRequest->message }}</p>

        <h2 style="font-size:18px;border-bottom:2px solid #D9A323;padding-bottom:8px">Photographs</h2>
        <p>
            {{ $quoteRequest->attachments->count() }} attached
            @if ($quoteRequest->attachments->isNotEmpty())
                <span>: {{ $quoteRequest->attachments->pluck('original_name')->map(fn ($name) => basename($name))->join(', ') }}</span>
            @endif
        </p>

        <h2 style="font-size:18px;border-bottom:2px solid #D9A323;padding-bottom:8px">Submission information</h2>
        <p>
            <strong>Submitted:</strong> {{ $quoteRequest->created_at->format('j F Y, g:i a') }}<br>
            <strong>Reference:</strong> {{ $quoteRequest->reference }}
            @if ($quoteRequest->ip_address)
                <br><strong>IP address:</strong> {{ $quoteRequest->ip_address }}
            @endif
        </p>

        <p>
            <a href="mailto:{{ $quoteRequest->email }}?subject={{ rawurlencode('Re: Touch2finish quote request '.$quoteRequest->reference) }}" style="display:inline-block;background:#D9A323;color:#03403F;padding:11px 16px;text-decoration:none;font-weight:bold">Reply by email</a>
            <a href="tel:{{ $quoteRequest->phone }}">Call customer</a>
            @if ($safeWhatsapp)
                &middot; <a href="https://wa.me/{{ $safeWhatsapp }}">Open WhatsApp</a>
            @endif
        </p>
    </div>
</div>
</body>
</html>
