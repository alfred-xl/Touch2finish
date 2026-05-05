<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuoteRequestMail;

class ContactController extends Controller
{
    /**
     * Handle the quote request form submission.
     */
    public function submitQuote(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'phone'   => ['required', 'string', 'max:30'],
            'service' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ], [
            'name.required'    => 'Please enter your full name.',
            'email.required'   => 'Please enter a valid email address.',
            'email.email'      => 'The email address you entered is not valid.',
            'phone.required'   => 'Please enter your phone number.',
            'service.required' => 'Please select the service you require.',
            'message.required' => 'Please provide some details about your project.',
            'message.min'      => 'Please give us a bit more detail about your project (at least 10 characters).',
        ]);

        // Send the email notification to Touch2finish
        Mail::to('info@touch2finish.co.uk')->send(new QuoteRequestMail($validated));

        return redirect('/#contact')->with(
            'success',
            'Thank you, ' . $validated['name'] . '! Your quote request has been sent. We\'ll be in touch within 24 hours.'
        );
    }

    /**
     * Display the dynamic service page.
     */
    public function showService(string $slug)
    {
        $services = $this->getServicesData();

        if (! array_key_exists($slug, $services)) {
            abort(404);
        }

        return view('service', [
            'service' => $services[$slug],
        ]);
    }

    /**
     * All service data — single source of truth for dynamic pages.
     */
    private function getServicesData(): array
    {
        return [
            'removals-handyman' => [
                'slug'  => 'removals-handyman',
                'title' => 'Removals & HandyMan',
                'icon'  => 'truck',
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80',
                'writeup' => "Moving home or office is one of life's most demanding undertakings. At Touch2finish, we remove that burden entirely. Our removals service is built on a foundation of care, precision, and reliability — treating your possessions as if they were our own.

Whether you're moving a single item across town or relocating an entire office to a new city, our team arrives on time, fully equipped, and ready to work. We specialise in handling everything from standard household furniture to uniquely fragile and high-value items that demand expert attention.

Our handyman services extend far beyond the move itself. Need shelving assembled, a TV wall-mounted, a door rehung, or general repairs attended to before you settle in? Our skilled tradespeople handle it all — saving you the hassle of managing multiple contractors.

We understand that every move has a unique set of challenges. That's why we begin every project with a thorough consultation to understand your timeline, your concerns, and your priorities. The result is a seamless, stress-free experience from the first box packed to the final item placed.",

                'benefits' => [
                    'Local and long-distance moves handled with equal professionalism',
                    'Specialist packing materials provided for fragile and high-value items',
                    'Fully insured — your belongings are protected throughout',
                    'Punctual, uniformed, and highly trained removal operatives',
                ],
            ],

            'car-valeting' => [
                'slug'  => 'car-valeting',
                'title' => 'Car Valeting & Wash',
                'icon'  => 'car',
                'image' => 'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=1600&q=80',
                'writeup' => "Your vehicle is an extension of your personal standard. At Touch2finish, we treat every car, van, and SUV as a premium asset deserving of meticulous care — whether it's a daily driver or a cherished classic.

Our valeting service goes far beyond a standard wash. We offer a comprehensive range of interior and exterior detailing packages designed to restore your vehicle to showroom condition. From decontamination washes and clay bar treatments to deep interior steam cleans and leather conditioning, every service is delivered with professional-grade products and a trained eye for detail.

We work with private clients, corporate fleets, and dealerships — adapting our service and scheduling to meet your needs. Our team comes to you, minimising disruption to your day while delivering results that speak for themselves.

The Touch2finish difference lies in our finishing. We don't consider a vehicle complete until every panel is flawless, every surface is treated, and every detail — from the door jambs to the wheel arches — meets our exacting standard.",

                'benefits' => [
                    'Showroom-grade results using professional-grade products and equipment',
                    'Full interior and exterior detailing packages available',
                    'Mobile service — we come to your home or workplace',
                    'Fleet and corporate accounts available at competitive rates',
                ],
            ],

            'interior-decor' => [
                'slug'  => 'interior-decor',
                'title' => 'Interior Decor & Refurb',
                'icon'  => 'paint-roller',
                'image' => 'https://images.unsplash.com/photo-1505691938895-1758d7def511?auto=format&fit=crop&w=1600&q=80',
                'writeup' => "The space you inhabit shapes your daily experience. Whether it's a home that needs refreshing, a rental property being turned around, or a commercial space requiring a full transformation — Touch2finish delivers interior decoration and refurbishment of an exceptional standard.

Our decorators are skilled craftspeople who take enormous pride in their finish. Perfect lines, flawless surfaces, and meticulous preparation are non-negotiable. We understand that poor preparation leads to poor results — so we invest the time upfront to ensure that everything we apply looks immaculate and lasts.

Our refurbishment services cover everything from full room transformations to targeted improvements: feature walls, ceiling roses, coving installation, wallpaper hanging, specialist paint finishes, and full property make-overs for landlords and developers.

We work closely with our clients to understand their vision, suggest complementary colour palettes and finishes, and bring their ideas to life — on time, within budget, and to a standard they'll be proud of for years to come.",

                'benefits' => [
                    'Expert preparation — the foundation of a lasting, premium finish',
                    'Wide range of paint finishes, specialist coatings, and wallpapers available',
                    'Landlord and letting agent refurbishment packages',
                    'Clean, tidy, and fully respectful of your property throughout',
                ],
            ],

            'real-estate' => [
                'slug'  => 'real-estate',
                'title' => 'Real Estate Development',
                'icon'  => 'building-2',
                'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1600&q=80',
                'writeup' => "Real estate development demands expertise, strategic vision, and absolute reliability. At Touch2finish, we bring all three — providing end-to-end property development services that transform opportunities into outstanding assets.

We work with private investors, landlords, and developers to identify potential, maximise value, and deliver projects that exceed expectations. Our integrated approach means you deal with a single, accountable team rather than juggling multiple contractors — streamlining communication, timelines, and budgets.

Our services span property acquisition support, planning and design consultation, full refurbishment and fit-out, project management, and final presentation. We understand that return on investment is paramount in development, and every decision we make is guided by a combination of aesthetic excellence and financial pragmatism.

From single property HMO conversions to multi-unit residential developments, we bring the same commitment to quality and the same rigorous project management discipline. The result: beautiful, high-value properties delivered on schedule.",

                'benefits' => [
                    'End-to-end project management — one point of contact throughout',
                    'Trusted network of architects, surveyors, and planning consultants',
                    'ROI-focused decision making at every stage of the project',
                    'Detailed progress reporting and full financial transparency',
                ],
            ],

            'cleaning' => [
                'slug'  => 'cleaning',
                'title' => 'Private & Commercial Cleaning',
                'icon'  => 'sparkles',
                'image' => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=1600&q=80',
                'writeup' => "Cleanliness is not just about appearance — it's about the environment you and your team inhabit every day. At Touch2finish, our cleaning service is built on the same uncompromising standard as every service we offer: thorough, reliable, and executed with genuine pride.

We provide domestic and commercial cleaning services tailored to the specific needs of each client. For private homes, we offer regular scheduled cleans, deep cleans, end-of-tenancy cleans, and post-construction cleans that restore a property to its absolute best.

For businesses, we provide flexible contract cleaning schedules designed to keep your premises immaculate without disrupting your operations. Our teams work early mornings, evenings, and weekends — whatever suits your business rhythm.

Every member of our cleaning team is vetted, trained, and equipped with professional-grade products that are effective, safe, and considerate of your surfaces and environment. We bring our own supplies, we work efficiently, and we leave every space spotless — every single time.",

                'benefits' => [
                    'Fully vetted, trained, and uniformed cleaning operatives',
                    'Professional-grade, environmentally considerate cleaning products',
                    'Flexible scheduling — including early mornings, evenings, and weekends',
                    'Comprehensive end-of-tenancy and post-construction cleans available',
                ],
            ],
        ];
    }
}
