Hello {{$user->name}}!
You just created an account.
Please verify your email using the link bellow:
{{route('verify', $user->verification_token)}}
