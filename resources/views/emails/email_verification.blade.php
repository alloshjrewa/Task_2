<x-mail::message>
# Email Verification

<<<<<<< HEAD
# Email Verification Code is {{ $user->remember_token }}
=======
# Email Verification Code is {{ $user->verification_code }}
>>>>>>> 2caf74e (task_3)

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
