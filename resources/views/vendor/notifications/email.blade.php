@component('mail::message')
# Hello

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $actionUrl])
Reset Password
@endcomponent

This password reset link will expire in 60 minutes.

If you did not request a password reset, no further action is required.

Thanks,<br>
{{ config('app.name') }}

{{-- Display the raw URL --}}
If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
{{ $actionUrl }}
@endcomponent