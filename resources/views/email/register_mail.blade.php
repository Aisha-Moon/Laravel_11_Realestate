@component('mail::message')
# Welcome to {{ config('app.name') }}

Hello {{ $user->name }},

Thank you for registering with us! To complete your registration, please set your password by clicking the button below.

@component('mail::button', ['url' => url('set_new_password/'.$user->remember_token)])
Set Your Password
@endcomponent

If you did not register an account, no further action is required.

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
