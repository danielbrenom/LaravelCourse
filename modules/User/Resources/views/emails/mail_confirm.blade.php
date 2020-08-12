@component('mail::message')
    # Hello {{$user->name}}.
    You have changed your email. Please verify you email address using the button below:
    @component('mail::button', ['url' => route('verify', $user->verification_token)])
        Verify account
    @endcomponent
    Thanks, <br>
    {{config('app.name')}}
@endcomponent
