@props(['faqs'])

<div x-data="{ open: 0 }" class="mt-10 divide-y divide-touch-border border-y border-touch-border">
    @foreach ($faqs as $index => $faq)
        <div>
            <h3>
                <button type="button" class="faq-trigger" @click="open = open === {{ $index }} ? -1 : {{ $index }}"
                    :aria-expanded="(open === {{ $index }}).toString()" aria-controls="faq-answer-{{ $index }}">
                    <span>{{ $faq['question'] }}</span>
                    <span class="shrink-0 transition-transform duration-200" :class="open === {{ $index }} ? 'rotate-45' : ''">
                        <i data-lucide="plus" class="h-5 w-5" aria-hidden="true"></i>
                    </span>
                </button>
            </h3>
            <div id="faq-answer-{{ $index }}" x-show="open === {{ $index }}" x-cloak class="pb-6 pr-10">
                <p class="max-w-3xl text-sm leading-7 text-touch-muted">{{ $faq['answer'] }}</p>
            </div>
        </div>
    @endforeach
</div>
