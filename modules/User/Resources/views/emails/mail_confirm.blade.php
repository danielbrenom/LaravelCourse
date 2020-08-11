Hello {{$user->name}}.
You have changed your email. Please verify you email address using the link below:
{{route('verify', $user->verification_token)}}
