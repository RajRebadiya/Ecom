<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail</title>
</head>

<body>
    <p>{{ $user->name }},</p>
    <p><span style="color:blue; font-weight:800">{{ $otpmsg }}</span> is your one-time passcode (OTP) for Your
        E-commerce app.</p>
    <p>You can tap on the code to have it automatically applied. If this doesn’t work, please either Copy and Paste or
        enter the code manually when prompted in the App.</p>
    <p>The code was requested from the E-commerce App. It will be valid for 4 hours.</p>
    <p>Enjoy the app!</p>
</body>

</html>
