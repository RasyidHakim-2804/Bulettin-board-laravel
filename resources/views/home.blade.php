<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @include('bootstrap.link')
  <title>Home</title>
</head>
<body style=" background-color:#bab7b7">
  {{-- navbar --}}

  @include('bootstrap.navbar', ['dashboard'=> true])
  {{-- <!-- Navbar -->
  <nav class="navbar navbar-expand-lg sticky-top bg-primary b-3">
    <!-- Container wrapper -->
    <div class="container">
      <!-- Navbar brand -->
      <a class="navbar-brand me-2" href="https://www.youtube.com/watch?v=xvFZjo5PgG0">
        <img
          src="https://img.icons8.com/ios-filled/50/FFFFFF/filled-message.png"
          height="20"
          alt="Logo"
          loading="lazy"
          style="margin-top: -1px;"
        />
      </a>

      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarButtonsExample"
        aria-controls="navbarButtonsExample"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarButtonsExample">
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-light" href="/posts">Dashboard</a>
          </li>
        </ul>
        <!-- Left links -->

        <div class="d-flex align-items-center px-3">
          @auth
          <a href="/logout" class="text-light text-decoration-none mx-2">Logout</a>
          @endauth

          @guest
          <a href="login" class="text-decoration-none text-light mx-2">Login</a>
          @endguest
        </div>
      </div>
      <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
  </nav>
<!-- Navbar --> --}}

{{-- end navbar --}}
<div class="container my-4">
  <div class="row row-cols-1 row-cols-md-1 g-2">
    @if ($posts->all() === [])
    <div class="col">
      <div class="card w-100" style="width: 18.5rem">
        <div class="card-body">
          <h5 class="card-title">NULL</h5>
          <h6 class="card-subtitle my-1 text-muted">EMPYT</h6>
          <p class="card-text overflow-hidden" style="height: 6rem">Sorry, the post still empty. Please create the post</p>
        </div>
      </div>
    </div>    
    @endif
    
    @isset($posts)
    @foreach ($posts as $post)
    <div class="col">
      <div class="card w-100" style="width: 18.5rem">
        <div class="card-body">
          <h5 class="card-title">Title: {{$post->title}}</h5>
          <h6 class="card-subtitle my-1 text-muted">Author: {{$post->user->user_name}}</h6>
          <p class="card-text overflow-hidden" style="height: 6rem">{{$post->body}}</p>
          <h6 class="card-subtitle my-1 text-muted">Update At: {{date('d-m-Y', strtotime($post->updated_at))}}</h6>
        </div>
      </div>
    </div>
    @endforeach        
    @endisset
  </div>
</div>

  {{-- paginator --}}
  <div>
    {{ $posts->links('vendor.pagination.bootstrap-5') }}
  </div>   
  
  @include('bootstrap.script')
</body>
</html>