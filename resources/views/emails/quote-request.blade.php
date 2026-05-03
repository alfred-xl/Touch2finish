<x-mail::message>
    # New Quote Request Received

    You have received a new service request from the website.

    **Client Details:**
    * **Name:** {{ $quoteData['name'] }}
    * **Email:** [{{ $quoteData['email'] }}](mailto:{{ $quoteData['email'] }})
    * **Phone:** {{ $quoteData['phone'] }}

    **Service Required:**
    {{ $quoteData['service'] }}

    **Project Details:**
    <x-mail::panel>
        {{ $quoteData['message'] }}
    </x-mail::panel>

    <x-mail::button :url="'mailto:' . $quoteData['email']">
        Reply to Client
    </x-mail::button>

    Thanks,<br>
    Touch2finish System
</x-mail::message>
