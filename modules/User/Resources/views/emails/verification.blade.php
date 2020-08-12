@component('mail::message')
    # Hello {{$user->name}}.
    You just created an account.
    Please verify your email using the button below:
    @component('mail::button', ['url' => route('verify', $user->verification_token)])
        Verify account
    @endcomponent
    Thanks, <br>
    {{config('app.name')}}
@endcomponent
