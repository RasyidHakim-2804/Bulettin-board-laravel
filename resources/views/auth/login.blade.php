<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- bootstap --}}
  @include('bootstrap.link')
  <title>Login</title>
</head>
<body>
  {{-- error --}}
  @include('bootstrap.error')

  @hasSection ('status')
    <h3>Registration has been successful</h3>
  @endif

  <div class="container text-left border-primary p-5 mt-5 mb-5 position-relative shadow bg-body-tertiary rounded">
    <div class="mx-auto mb-4">
      <img src="https://img.icons8.com/ios-filled/50/1A1A1A/user-male-circle.png" 
           alt="akun"
           class="d-block mx-auto">
    </div>
    <form action="/login" method="POST">
      @csrf
      <div class="row mb-3">
        <label for="user_name" class="form-label">Username</label>
        <input type="text" name="user_name" class="form-control">
      </div>
      <div class="row mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" placeholder="" class="form-control">  
      </div>   
      <div class="row mb-3">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary w-100">
      </div>
      <div class="row mb-3 d-flex">
        <a href="/registration" class="text-decoration-none d-inline-block">Sign Up</a>
        <a href="/home" class="text-decoration-none d-inline-block">Home</a>
      </div>
    </form>
  </div>
  
  
  {{-- bootstrap --}}
  @include('bootstrap.script')
</body>
</html>