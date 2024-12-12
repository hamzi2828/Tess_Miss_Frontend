<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Request</title>
</head>
<body>
    <p>Hello,</p>
    <p>We received a request to reset your password. Click the link below to reset it:</p>
    <a href="{{ $resetLink }}">{{ $resetLink }}</a>
    <p>If you did not request a password reset, please ignore this email.</p>
    <p>Thank you!</p>
</body>
</html>
