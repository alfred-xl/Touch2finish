<x-mail::message>

    # 🔔 New Quote Request Received

    A new service enquiry has been submitted via the Touch2finish website.

    ---

    ## Client Details

    | Field | Value |
    |-------|-------|
    | **Name** | {{ $quoteData['name'] }} |
    | **Email** | {{ $quoteData['email'] }} |
    | **Phone** | {{ $quoteData['phone'] }} |
    | **Service Required** | {{ $quoteData['service'] }} |

    ---

    ## Project Details

    <x-mail::panel>
        {{ $quoteData['message'] }}
    </x-mail::panel>

    ---

    **Action Required:** Please respond to this enquiry within 24 hours to maintain your service standard.

    <x-mail::button :url="'mailto:' .
        $quoteData['email'] .
        '?subject=Re: Your Touch2finish Quote Request for ' .
        urlencode($quoteData['service'])" color="primary">
        Reply to {{ $quoteData['name'] }}
    </x-mail::button>

    ---

    *This email was generated automatically by the Touch2finish website. The client's reply-to address has been set, so
    you can respond directly to this email.*

    Thanks,<br>
    **Touch2finish System**<br>
    [info@touch2finish.co.uk](mailto:info@touch2finish.co.uk)
</x-mail::message>
