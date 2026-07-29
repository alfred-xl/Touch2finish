@props(['services'])

<div x-data="{ active: 0 }" class="mt-12 grid gap-8 lg:grid-cols-[0.82fr_1.18fr] lg:gap-12">
    <div class="divide-y divide-touch-border border-y border-touch-border">
        @foreach ($services as $index => $service)
            <div>
                <button type="button" class="service-trigger" @click="active = active === {{ $index }} ? -1 : {{ $index }}"
                    :class="active === {{ $index }} ? 'service-trigger--active' : ''"
                    :aria-expanded="(active === {{ $index }}).toString()"
                    aria-controls="service-panel-{{ $index }} service-desktop-panel-{{ $index }}">
                    <span class="service-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="min-w-0 flex-1 text-left">
                        <span class="block font-display text-base font-semibold text-touch-dark sm:text-lg">{{ $service['title'] }}</span>
                        <span class="mt-1 hidden text-sm font-normal leading-6 text-touch-muted sm:block lg:hidden">{{ $service['short'] }}</span>
                    </span>
                    <span class="shrink-0 transition-transform duration-200" :class="active === {{ $index }} ? 'rotate-180' : ''">
                        <i data-lucide="chevron-down" class="h-5 w-5" aria-hidden="true"></i>
                    </span>
                </button>

                <div id="service-panel-{{ $index }}" x-show="active === {{ $index }}" x-transition.opacity.duration.250ms x-cloak
                    class="pb-7 pl-0 sm:pl-12 lg:hidden">
                    @if ($service['image'])<div class="service-image-frame mb-5"><img src="{{ asset($service['image']) }}" alt="{{ $service['image_alt'] }}" width="800" height="600" loading="lazy" style="object-position: {{ $service['image_position'] }}"></div>@endif
                    <x-site.service-detail :service="$service" />
                </div>
            </div>
        @endforeach
    </div>

    <div class="hidden lg:block">
        @foreach ($services as $index => $service)
            <div id="service-desktop-panel-{{ $index }}" x-show="active === {{ $index }}" x-transition.opacity.duration.250ms x-cloak class="service-detail-panel">
                @if ($service['image'])<div class="service-image-frame rounded-none border-0 border-b border-touch-border"><img src="{{ asset($service['image']) }}" alt="{{ $service['image_alt'] }}" width="1200" height="900" loading="lazy" style="object-position: {{ $service['image_position'] }}"></div>
                @else<div class="service-visual" aria-hidden="true"><i data-lucide="{{ $service['icon'] }}" class="h-16 w-16 text-touch-gold"></i><span class="mt-5 font-display text-sm font-semibold text-touch-dark">{{ $service['title'] }}</span></div>@endif
                <div class="p-8 xl:p-10">
                    <x-site.service-detail :service="$service" />
                </div>
            </div>
        @endforeach
    </div>
</div>
