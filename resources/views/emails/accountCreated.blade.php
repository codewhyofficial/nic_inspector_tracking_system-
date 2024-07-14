<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>document</title>
</head>

<body>

    <h1>Your Account has been Successfully created at Inspector Tracking System.</h1>
    <p>Your login Credentials are:-</p>
    
    <p>login Id: <span>{{ $mailData['userid']}}</span></p>
    <p>password: <span>{{ $mailData['password']}}</span></p>

    <p>Thank you</p>
</body>

</html>