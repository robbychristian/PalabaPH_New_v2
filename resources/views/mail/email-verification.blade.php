@component('mail::message')
    Click Below to Verify your account!

    <a href="">
        Verify
    </a>


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
