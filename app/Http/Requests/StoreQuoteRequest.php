<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQuoteRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $services = array_keys(config('touch2finish.services', []));
        $options = config('touch2finish.quote_form.options', []);

        return [
            'name' => ['required', 'string', 'max:120'], 'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['required', 'string', 'max:30'], 'postcode' => ['required', 'string', 'max:20'],
            'service' => ['required', 'string', Rule::in([...$services, config('touch2finish.quote_form.combined_slug')])],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'preferred_contact_method' => ['required', Rule::in(array_keys(config('touch2finish.quote_form.preferred_contact_methods', [])))],
            'message' => ['required', 'string', 'min:10', 'max:5000'], 'consent' => ['accepted'],
            'website' => ['nullable', 'prohibited'], 'photos' => ['nullable', 'array', 'max:4'],
            'photos.*' => ['file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'vehicle_make_model' => ['nullable', 'string', 'max:150'],
            'vehicle_size' => ['nullable', Rule::in(array_keys($options['vehicle_size'] ?? []))],
            'vehicle_condition' => ['nullable', Rule::in(array_keys($options['vehicle_condition'] ?? []))],
            'water_available' => ['nullable', Rule::in(array_keys($options['availability'] ?? []))],
            'electricity_available' => ['nullable', Rule::in(array_keys($options['availability'] ?? []))],
            'property_type' => ['nullable', Rule::in(array_keys($options['property_type'] ?? []))],
            'bedrooms' => ['nullable', 'integer', 'min:0', 'max:30'], 'bathrooms' => ['nullable', 'integer', 'min:0', 'max:30'],
            'cleaning_type' => ['nullable', Rule::in(array_keys($options['cleaning_type'] ?? []))],
            'occupancy_status' => ['nullable', Rule::in(array_keys($options['occupancy_status'] ?? []))],
            'collection_postcode' => ['nullable', 'string', 'max:20'], 'delivery_postcode' => ['nullable', 'string', 'max:20'],
            'property_size' => ['nullable', Rule::in(array_keys($options['property_size'] ?? []))],
            'floor_level' => ['nullable', 'string', 'max:150'],
            'lift_available' => ['nullable', Rule::in(array_keys($options['lift_available'] ?? []))],
            'moving_date' => ['nullable', 'date', 'after_or_equal:today'], 'large_items' => ['nullable', 'string', 'max:1500'],
            'task_list' => ['nullable', 'string', 'max:3000'],
            'materials_available' => ['nullable', Rule::in(array_keys($options['materials_available'] ?? []))],
            'number_of_rooms' => ['nullable', 'integer', 'min:1', 'max:50'],
            'property_status' => ['nullable', Rule::in(array_keys($options['property_status'] ?? []))],
            'surface_condition' => ['nullable', Rule::in(array_keys($options['surface_condition'] ?? []))],
            'desired_finish' => ['nullable', 'string', 'max:2000'],
            'combined_services' => ['nullable', 'array', 'max:5'], 'combined_services.*' => [Rule::in($services)],
            'combined_details' => ['nullable', 'string', 'max:3000'],
        ];
    }

    public function messages(): array
    {
        return [
            'postcode.required' => 'Please enter your postcode.',
            'preferred_contact_method.required' => 'Please select how you would prefer to be contacted.',
            'preferred_date.after_or_equal' => 'The preferred date cannot be in the past.',
            'moving_date.after_or_equal' => 'The preferred moving date cannot be in the past.',
            'photos.max' => 'You can upload a maximum of four photographs.',
            'photos.*.max' => 'Each photograph must be 3 MB or smaller.',
            'photos.*.image' => 'Photographs must be JPG, PNG or WebP images.',
            'photos.*.mimes' => 'Photographs must be JPG, PNG or WebP images.',
            'consent.accepted' => 'Please confirm that Touch2finish may use this information to respond to your enquiry.',
            'website.prohibited' => 'We could not submit your request. Please check the form and try again.',
        ];
    }

    protected function getRedirectUrl(): string { return route('home').'#contact'; }
}
