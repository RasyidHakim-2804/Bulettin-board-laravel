<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
</head>
<body>
  @if (session('status') === TRUE)
      <h3>Registration has been successful</h3>
  @endif
  <div>
    <form action="/login" method="POST">
    @csrf
      <label for="user_name">Username</label>
      <input type="text" name="user_name"><br>
      <label for="password">Password</label>
      <input type="password" name="password" placeholder=""><br>
      <input type="submit" name="submit" value="Submit">
    </form>
    <form action="/register" method="get">
      <input type="submit" value="Register">
    </form>
  </div>
</body>
</html>