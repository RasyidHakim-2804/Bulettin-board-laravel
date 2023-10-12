<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  {{-- bootstap --}}
  @include('bootstrap.link')
  <title>Forgot Password</title>
</head>
<body>
  {{-- error --}}
  @include('bootstrap.error')
  @include('bootstrap.success')

  <div class="container text-left border-primary p-5 mt-5 mb-5 position-relative shadow bg-body-tertiary rounded">
    <div class="mx-auto mb-4">
      <img src="https://img.icons8.com/ios-filled/50/1A1A1A/user-male-circle.png" 
           alt="akun"
           class="d-block mx-auto">
      <h2 class="d-block text-center">Forgot Password</h2>
    </div>
    <form action="{{route('password.email')}}" method="POST">
      @csrf
      <div class="row mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" class="form-control">
      </div>
      <div class="row mb-3">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary w-100">
      </div>
      <div class="row mb-3 d-flex">
        <a href="/login" class="text-decoration-none d-inline-block">Login</a>
      </div>
    </form>
  </div>
  
  
  {{-- bootstrap --}}
  @include('bootstrap.script')
</body>
</html>