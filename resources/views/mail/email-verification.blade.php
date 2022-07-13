@component('mail::message')
    Click Below to Verify your account!

    <a href="https://palabaph.com/verifyemail/{{ $email }}/{{ $data }}">
        Verify
    </a>


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
