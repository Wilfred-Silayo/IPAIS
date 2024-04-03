<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ config('app.name') }}</title>
</head>
<body>
    <h1>Welcome to {{ config('app.name') }}, {{ $user->first_name }}!</h1>

    <p>Thank you for registering with us.</p>

    @if (isset($temporaryPassword))
        <p>Here's your temporary password to get started:</p>
        <p><strong>{{ $temporaryPassword }}</strong></p>
        <p>Please note that this is a temporary password for your security. We highly recommend that you change your password to a strong one after logging in.</p>
    @else
        <p>You can now log in to your account using your email address and the password you set during registration.</p>
    @endif

    <p>We hope you enjoy using our platform!</p>

    <p>Sincerely,</p>
    <p>The {{ config('app.name') }} Team</p>
</body>
</html>
