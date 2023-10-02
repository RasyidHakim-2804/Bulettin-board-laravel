<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @include('bootstrap.link')
  <title>Bulletin Board</title>
</head>
<body>

  {{-- navbar --}}
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
            <a class="nav-link text-light" href="https://www.youtube.com/watch?v=xvFZjo5PgG0">Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="/logout">Logout</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="/home">Home</a>
          </li>
        </ul>
      </div>
      <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
  </nav>
  {{-- end navbar --}}

  <div class="position-relative mt-3 mx-3">
    @if(session('message'))
      <div class="alert alert-success p-3 text-center position-relative top-0 start-50 translate-middle-x" role="alert">{{session('message')}}</div> 
    @endif
  </div>

   {{-- error --}}
   @include('bootstrap.error')
 
  <div class="container text-left border-primary p-3 mt-3 position-relative">
    <p>Your message must be 10 to 200 characters long</p>
    <p>Spaces at the beginning and at the end of a sentence are not counted</p>

    <form action="/post" method="POST" class="shadow p-4 mb-3 bg-body-tertiary rounded">
    @csrf
      <div class="mb-3">
        <label for="title" class="from-label">Title:</label>
        <input type="text" name="title" class="form-control">
      </div>
      <div class="mb-3">
        <label for="post_content" class="from-label">Content:</label>
        <textarea name="post_contents" rows="3" style="resize:none" class="form-control"></textarea>
      </div>
      <input type="submit" name="submit" value="Submit" class="btn btn-primary">
      <input type="reset" value="Reset" class="btn btn-primary">
    </form>
  </div>
  <hr><br><br>

  <!-- show data -->

  <div class="container mb-5">
    {{$posts->links('vendor.pagination.bootstrap-5')}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
      @foreach ($posts as $post)
      <div class="col">
        <div class="card w-100" style="width: 18.5rem">
          <div class="card-body">
            <h5 class="card-title">Title: {{$post->title}}</h5>
            <h6 class="card-subtitle my-1 text-muted">Update At: {{date('d-m-Y', strtotime($post->updated_at))}}</h6>
            <p class="card-text overflow-hidden" style="height: 6rem">{{$post->posts_contents}}</p>
            <a href="/edit/{{$post->id}}" class="card-link text-decoration-none">Edit</a>
            <a href="/delete/{{$post->id}}" class="card-link text-decoration-none"  onclick="return confirm('Are you sure?')">Delete</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>




  
  <script>
    function toEdit(id){
      window.location =`/edit/${id}`;
    }

    function myDelete(id){
      const response = confirm('Are you sure want to delete it?');
      if(response){
        window.location = `/delete/${id}`;
      }
    }
  </script>
  @include('bootstrap.script')
</body>
</html>
