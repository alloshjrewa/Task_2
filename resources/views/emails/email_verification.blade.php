<x-mail::message>
# Email Verification

# Email Verification Code is {{ $user->remember_token }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
