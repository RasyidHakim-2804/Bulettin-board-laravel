<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
</head>
<body>
  {{-- error --}}
  <div class="error">
    @if ($errors->any())
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>        
        @endforeach
      </ul>
    @endif
  </div>
 
  <div>
    <form action="/register" method="POST">
    @csrf
      <label for="user_name">Username</label>
      <input type="text" name="user_name"><br>

      <label for="Email">Email</label>
      <input type="text" name="email"><br>
      
      <label for="password">Password</label>
      <input type="password" name="password" placeholder=""><br>
      
      <input type="submit" name="submit" value="Submit">
    </form>
  </div>
</body>
</html>