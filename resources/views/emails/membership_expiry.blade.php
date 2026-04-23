<!DOCTYPE html>
<html>
<head>
    <title>Membership Expiry Notification</title>
</head>
<body>
    <p>Dear {{ $member->name }},</p>

    <p>We wanted to remind you that your membership is about to expire on <strong>{{ $member->expiry_date ? $member->expiry_date->format('F j, Y') : 'N/A' }}</strong>.</p>

    <p>Please consider renewing your membership to continue enjoying our services without interruption.</p>

    <p>Thank you for being a valued member!</p>

    <p>Best regards,<br/>
    The Membership Team</p>
</body>
</html>
