<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- bootstap --}}
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
  <title>Login</title>
</head>
<body>
  @hasSection ('status')
    <h3>Registration has been successful</h3>
  @endif

  <form action="/login" method="POST" >
    <div>
      <label for="user_name">Username</label>
      <input type="text" name="user_name">
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" name="password" placeholder="">  
    </div>    
    <input type="submit" name="submit" value="Submit" >
    {{-- btn regis --}}
  </form>
  <input type="button" value="Registration" onclick="(function(){window.location = '/registration'})()">
  
  {{-- bootstrap --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
</body>
</html>