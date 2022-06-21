@component('mail::message')
    # Introduction

    The body of your message.

    @component('mail::button', ['url' => 'https://palabaph.com/verifyemail/{{ $eamil }}/{{ $token }}'])
        Verify Email
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
