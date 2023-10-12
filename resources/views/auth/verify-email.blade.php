<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Verification</title>
</head>
<body>
  <h1>Verification email has sended.</h1>
  <h3>Please check your email</h3>
  <p>click tihis url, if you already verified: 
    <a href="/posts">Dashboard</a>, 
    <a href="/home">Home</a>, 
    <a href="/logout">Logout</a>
  </p>
  <form method="POST" action="{{ route('verification.send') }}">
    <p>Still haven't gotten the email?</p>
    @csrf <!-- Token CSRF -->
    <button type="submit">Resend</button>
  </form>

</body>
</html>