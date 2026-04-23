<!DOCTYPE html>
<html>
<head>
    <title>Your Account Credentials</title>
</head>
<body>
    <p>Dear {{ $member->name }},</p>

    <p>Your member account has been created successfully. Here are your login credentials:</p>

    <p><strong>Email:</strong> {{ $member->email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>

    <p>Please change your password after your first login for security.</p>

    <p>Thank you for joining us!</p>

    <p>Best regards,<br/>
    The Membership Team</p>
</body>
</html>
