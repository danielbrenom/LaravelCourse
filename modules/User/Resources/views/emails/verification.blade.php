Hello {{$user->name}}!
You just created an account.
Please verify your email using the link below:
{{route('verify', $user->verification_token)}}
