<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @include('bootstrap.link')
  <title>Register</title>
</head>
<body class="bg-secondary">
  {{-- error --}}
  @include('bootstrap.error')

  <div class="position-absolute w-75 top-50 start-50 translate-middle shadow p-5 mb-5 bg-body-tertiary rounded">
    <div class="mx-auto mb-4">
      <img src="https://img.icons8.com/ios-filled/50/1A1A1A/user-male-circle.png" 
           alt="akun"
           class="d-block mx-auto">
      <h2 class="d-block text-center">Registration</h2>
    </div>
    <form action="/register" method="POST">
      @csrf
      <div class="row mb-3">
        <label for="user_name" class="form-label">Username</label>
        <input type="text" name="user_name" class="form-control">
      </div>
      <div class="row mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" class="form-control">
      </div>
      <div class="row mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" name="password" placeholder="" class="form-control">  
      </div>  
      <div class="row mb-3 mt-3">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-3">
        <a href="/login" class="text-decoration-none d-inline-block mt-3 ml-0">Login</a>
      </div>
    </form>
  </div>
 
  {{-- <div>
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
  </div> --}}

  @include('bootstrap.script')
</body>
</html>