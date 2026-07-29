@props(['service'])

<p class="text-base font-medium leading-7 text-touch-text">{{ $service['short'] }}</p>
<p class="mt-4 text-sm leading-7 text-touch-muted">{{ $service['detail'] }}</p>
<div class="mt-6">
    <p class="text-xs font-bold uppercase tracking-[0.14em] text-touch-gold">Possible inclusions</p>
    <ul class="mt-3 grid gap-x-6 gap-y-2 sm:grid-cols-2">
        @foreach ($service['inclusions'] as $inclusion)
            <li class="flex items-start gap-2 text-sm leading-6 text-touch-text">
                <i data-lucide="check" class="mt-1 h-4 w-4 shrink-0 text-touch-gold" aria-hidden="true"></i>
                <span>{{ $inclusion }}</span>
            </li>
        @endforeach
    </ul>
</div>
<a href="{{ $service['href'] }}" class="btn-text mt-6">
    {{ $service['cta'] }}
    <i data-lucide="arrow-right" class="h-4 w-4" aria-hidden="true"></i>
</a>
