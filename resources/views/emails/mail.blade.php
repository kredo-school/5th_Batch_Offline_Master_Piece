<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Confirmation</title>
</head>
<body>
    <p>Hello {{ $data['firstname'] }} {{ $data['lastname'] }},</p>
    <p>Thank you for reaching out! We have received your inquiry with the following details:</p>

    <ul>
        <li>Email: {{ $data['email'] }}</li>
        <li>Phone: {{ $data['phone'] }}</li>
        <li>Role: {{ ucfirst($data['role']) }}</li>
        <li>Inquiry Type: {{ ucfirst($data['contact']) }}</li>
        <li>Details: {{ $data['details'] }}</li>
    </ul>

    <p>We will get back to you as soon as possible.</p>

    <p>Best regards,<br>Bookstore Team</p>
</body>
</html>





